#!/usr/bin/perl

## Create pathways on WikiPathways
## For every pathway this script:
##      - uploads the pathway image
##      - uploads the GPML file
##      - uploads the MAPP file
##      - creates a wiki page
## Category tags will be assigned to each page

# The input is a file in the following format
#
# What you write                Explanation
#----------------------------------------------------------------------------
# @[[Category:Metabolism]]    	This text is appended to every description (use it for categories).
# >Hs_apoptosis	                Name of the pathway (without file extension), following the GenMAPP naming conventions
#
# The "@" line is optional, and must be in one line. It can
# occur multiple times in a single file and are only valid until they
# are changed.
#
# To set the wiki account information, you need to create a file wiki.cfg in the script directory
# containing 2 lines:
# user=USERNAME
# password=PASSWORD

package main;
use warnings;
use strict;
use Getopt::Long;
use IO::File;

my $usage =
"USAGE:
perl uploadPathways.pl directory [pathwaylist] [ovrFiles] [ovrPages]
	- directory: 
		the directory containing the pathway list and pathway files:
	- image files: 
		.jpg files located in directory/img
	- genmapp files: 
		.mapp files located in directory/mapp
	- gpml files: 
		.gpml files located in directory/gpml
	- pathwaylist: 
		the file that contains the list of pathways and
		optional text that will be appended to the wiki pages (default: pathways.txt)
	- ovrFiles: 
		optional parameter to specify whether the uploaded files have to be overwritten when a file
		with the same name already exists on the wiki
	-ovrPages: 
		optional parameter to specify whether the pathway pages have to be overwritten when page
		with the same name already exists on the wiki

	Both the pathway names in the pathway list and the pathway files must be named according to the convention:
	SpeciesCode_PathwayName ([A-Z][a-z]_.*), e.g. Hs_apoptosis.

	To set the wiki account information, you need to create a file wiki.cfg in the script directory
	containing 2 lines:
		user=USERNAME
		password=PASSWORD\n";

#The URL pointing to the wiki index.php
my $wiki_php = "http://localhost/wikipathways/index.php"; #Tryout wiki
#my $wiki_php = "http://blog.bigcat.unimaas.nl/wikipathways/index.php";

#Read configuration options
my $config = readconfig("wiki.cfg");

#The username and password to use for the wiki
my $user = $config->{"user"};
my $pass = $config->{"password"};

my $dir;
my $pathwayList;
my $ovrFiles;
my $ovrPages;

#Command line arguments
my $result = GetOptions (
	"directory=s" => \$dir,
	"pathwaylist=s" => \$pathwayList,
	"ovrFiles=s" => \$ovrFiles,
	"ovrPages=s" => \$ovrPages,
);
chdir $dir or die "Can't change to directory: $dir\n$usage";

if(!$pathwayList) {
        $pathwayList = "pathways.txt";
}

#Pathway file types to upload
my @fileType = (
        {var => "imagePage", directory=>"img", extension=>"svg", addCategories=>1},
        {var => "gpmlPage", directory=>"gpml", extension=>"gpml"},
        {var => "mappPage", directory=>"mapp", extension=>"mapp"},
);

#Mappings from 2 character species codes to species names
my %species = (
        "Mm" => "Mouse",
        "Hs" => "Human",
	"Rn" => "Rat",
	"Sc" => "Yeast", #TODO: complete species list
);


my $wiki = MediaWiki->new($wiki_php);

$wiki->connect($user, $pass);

my %pathways = parsePathwayList($pathwayList);

foreach my $pathway (keys %pathways) {
        print "Processing pathway $pathway\n";
        my ($name, $species) = parsePathwayName($pathway);
        if(!defined $species) {
                print "!! Couldn't find pathway species, make sure the filename starts with
                        the two character species code, followed by an underscore\n";
        }
        my $pagename = "$species:$name";
        my $pagetext = "<!-- DON'T MODIFY THIS PART OF THE PAGE, IT IS AUTOMATICALLY GENERATED -->\n";

        ## Add the page template
        $pagetext .= "{{Template:PathwayPage";
        foreach (@fileType) {
                my %type = %{ $_ };
                $pagetext .= "|$type{var}=Image:$pathway.$type{extension}";
        }
        $pagetext .= "}}\n";

        $pagetext .= "<!-- YOU CAN MODIFY THE PAGE FROM HERE -->\n\n";

        # Add text parsed from pathway list
        $pagetext .= $pathways{$pathway}."\n"."[[Category:$species|{{PAGENAME}}]]\n";
        $pagetext .=
"<!-- You can add this pathway to a category by adding '[[Category:CategoryName]]' to the end of this
page, where 'CategoryName' is the category you want to add the pathway to -->\n";

        print "\tCreating wiki-page $pagename\n";
        $wiki->setPageContent($pagename, $pagetext, { overwrite=>$ovrPages });
        print "\tUploading pathway files\n";
        uploadPathwayFiles($pathway, $pagename, $pathways{$pathway});
}

sub parsePathwayName {
        my $pathway = shift;
        $pathway =~ /^([A-Z][a-z])_(.*)$/;
        ($2, $species{$1})
}

sub getSpeciesCode {
        my $pathway = shift;
        $pathway =~ /^([A-Z][a-z]) /;
        $1;
}


sub parsePathwayList {
        my $listFile = shift;

        my %pathways;

        open(PATHWAYLIST,"<$listFile")
                or die "!! Could not find pathway list at $listFile.\n$usage";

        my $text = "";
        while(<PATHWAYLIST>) {
                my $line = $_;
                chomp($line);
                if($line =~ m/^@/) {
                        $line =~ s/^@//;
                        $text = $line;
                }
                elsif($line =~ m/^>/) {
                        $line =~ s/^>//;
                        $pathways{$line} = $text;
                }
        }
        %pathways;
}

sub uploadPathwayFiles {
        my $pathway = shift;
        my $pathwayPage = shift;
        my $description = shift;
        foreach (@fileType) {
                my %type = %{ $_ };
                my $pwLink = "$type{extension} file for [[$pathwayPage]]";

                my ($dir, $ext) = ($type{directory}, $type{extension});

                my $file = "$pathway.$ext";

                print "\t\tProcessing file $file\n";
                ## Check if file extists
                if(-e "$dir/$file") {
                        # Only add description parsed from pathway list to file types with addCategories set
                        my $descr = "$pwLink\n";
                        if($type{addCategories}) {
                                print "\t> Adding description: $description\n";
                                $descr .= $description;
                        }
                        $wiki->uploadFile("$dir/$file",$descr,{ wikiname=>$file, ignoreWarnings=>$ovrFiles });
			$wiki->setFileDescription($file,$descr, { overwrite=>$ovrFiles }); #Description not overwritten by uploading, so do it manually
                } else {
                        print "!! Skipped file: $file does not exist\n";
                }
        }
}

sub readconfig {
    my $file = shift;
    my %params;
    my $fh= IO::File->new($file, "r") or die "$file: $!";
    while (<$fh>) {
        s/\s+$//;
        if (/(\w+)\s*=\s*(.*)/) {
            my ($k, $v)= ($1, $2);
            $params{$k}= $v;
        }
    }
    $fh->close();
    return \%params;
}

package MediaWiki;
use WWW::Mechanize;
use Encode qw(encode);

sub new {
        my $class= shift;
        my $php = shift;
        my $self= bless {
                php=> $php,
                browser=> LWP::UserAgent->new(),
                mech=>WWW::Mechanize->new()
        }, $class;

    return $self;
}

sub connect() {
        my $self = shift;
        my $username = shift;
        my $password = shift;

        my $mech = $self->{mech};
        my $php = $self->{php};

        $mech->get ("$php?title=Special:Userlogin");
        $mech->submit_form(
               form_name => 'userlogin',
               fields      => 
                                {
                                wpName  => $username,
                                wpPassword  => $password,
                                }
            );
}
  
sub uploadFile {
        my $self = shift;
        my $file = shift;
        my $descr = shift;
	my $wikiname;
	my $ignoreWarnings;
	
	my $options_ref = shift();
	
	if($options_ref) {
		my %options = %{ $options_ref };
		$ignoreWarnings = $options{ignoreWarnings};
		$wikiname = $options{wikiname};
	}

        my $mech = $self->{mech};
        my $php = $self->{php};

        
        print "Uploading $file. Description:\n";
        print $descr."\n" . "-" x 75 . "\n";

        my $eckey=encode('utf8',$file);
         if($eckey ne $file) {
                symlink("$file","$eckey");
        }
        $mech->get("$php?title=Special:Upload");
		my $content = $mech->content;
		if($mech->content =~ m/Not logged in/) {
			print "Upload failed, user not logged in!";
			return;
		}
        my $response = $mech->submit_form(
        button => 'wpUpload',
        fields  => {
          wpUploadFile=>["$eckey"],
          wpDestFile=>"$wikiname",
          wpUploadDescription=>encode('utf8',$descr),
          wpIgnoreWarning=>$ignoreWarnings?'true':undef
  	});
  	if($response->as_string =~ m%<h2>Upload warning</h2>%) {
          print "Upload failed! Possibly the file already exists and you didn't specify the 'overwrite' option\n";
  	} else {
          print "Uploaded successfully.\n";
  	} ## TODO: validate response properly
}

sub getPageContent {
        my $self = shift;
        my $page = shift;

        my $mech = $self->{mech};
        my $php = $self->{php};

        $mech->get("$php?title=$page&action=edit");
        $mech->content =~ /<textarea .*?>(.*?)<\/textarea>/gs;
        $1;
}

sub setPageContent {
        my $self = shift;
        my $page = shift;
        my $text = shift;
        
	my $append;
	my $overwrite;
	
	my $options_ref = shift();
	
	if($options_ref) {
		my %options = %{ $options_ref };
		$append = $options{append};
		$overwrite = $options{overwrite};
	}
        my $mech = $self->{mech};
        my $php = $self->{php};

        $mech->get("$php?title=$page&action=edit");
	
	$mech->content =~ /<textarea .*?>(.*?)<\/textarea>/gs;
	
	my $content = $1;
	chomp($content);
	if($content ne "") { #page exists
		if ($append) {
			print "\t> Page already exists, appending to existing page content\n";
			$text = "$1\n$text";
		} elsif (!$overwrite) {
			print "\t> Page already exists, skipping (set option 'overwrite' or 'append' if you want to modify existing pages)\n";
			return;
		} else {
			print "\t> Page already exists, overwriting existing page content\n";
		}
	}

        $mech->submit_form(
                form_name => 'editform',
                fields => {
                        wpTextbox1 => $text
        });
        ##TODO: validate response
}

sub setFileDescription {
        my $self = shift;
        my $filepage = shift;
        my $descr = shift;
        
	my $append;
	my $overwrite;
	
	my $options_ref = shift();

        my $mech = $self->{mech};
        my $php = $self->{php};

        if(!($filepage =~ m/^Image:/)) {
                $filepage = "Image:$filepage";
        }
        $self->setPageContent($filepage, $descr, $options_ref);
        ##TODO: validate response
}
