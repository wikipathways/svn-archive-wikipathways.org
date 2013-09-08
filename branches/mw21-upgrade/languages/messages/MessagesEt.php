<?php
/** Estonian (Eesti)
 *
 * See MessagesQqq.php for message documentation incl. usage of parameters
 * To improve a translation please visit http://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 * @author Avjoska
 * @author Hendrix
 * @author Jaan513
 * @author KalmerE.
 * @author Ker
 * @author Pikne
 * @author Silvar
 * @author Võrok
 * @author WikedKentaur
 * @author לערי ריינהארט
 */

$namespaceNames = array(
	NS_MEDIA            => 'Meedia',
	NS_SPECIAL          => 'Eri',
	NS_MAIN             => '',
	NS_TALK             => 'Arutelu',
	NS_USER             => 'Kasutaja',
	NS_USER_TALK        => 'Kasutaja_arutelu',
	# NS_PROJECT set by $wgMetaNamespace
	NS_PROJECT_TALK     => '$1_arutelu',
	NS_IMAGE            => 'Pilt',
	NS_IMAGE_TALK       => 'Pildi_arutelu',
	NS_MEDIAWIKI        => 'MediaWiki',
	NS_MEDIAWIKI_TALK   => 'MediaWiki_arutelu',
	NS_TEMPLATE         => 'Mall',
	NS_TEMPLATE_TALK    => 'Malli_arutelu',
	NS_HELP             => 'Juhend',
	NS_HELP_TALK        => 'Juhendi_arutelu',
	NS_CATEGORY         => 'Kategooria',
	NS_CATEGORY_TALK    => 'Kategooria_arutelu'
);

$skinNames = array(
	'standard' => 'Standard',
	'nostalgia' => 'Nostalgia',
	'cologneblue' => 'Kölni sinine',
	'monobook' => 'MonoBook',
	'myskin' => 'Mu oma nahk'
);

#Lisasin eestimaised poed, aga võõramaiseid ei julenud kustutada.

$bookstoreList = array(
	'Apollo' => 'http://www.apollo.ee/search.php?keyword=$1&search=OTSI',
	'minu Raamat' => 'http://www.raamat.ee/advanced_search_result.php?keywords=$1',
	'Raamatukoi' => 'http://www.raamatukoi.ee/cgi-bin/index?valik=otsing&paring=$1',
	'AddALL' => 'http://www.addall.com/New/Partner.cgi?query=$1&type=ISBN',
	'PriceSCAN' => 'http://www.pricescan.com/books/bookDetail.asp?isbn=$1',
	'Barnes & Noble' => 'http://search.barnesandnoble.com/bookSearch/isbnInquiry.asp?isbn=$1',
	'Amazon.com' => 'http://www.amazon.com/exec/obidos/ISBN=$1'
);


$magicWords = array(
	#   ID                                 CASE  SYNONYMS
	'redirect'               => array( 0,    '#redirect', "#suuna"    ),
);

$separatorTransformTable = array(',' => "\xc2\xa0", '.' => ',' );
$linkTrail = "/^([a-z]+)(.*)\$/sD";

$datePreferences = array(
	'default',
	'et numeric',
	'dmy',
	'et roman',
	'ISO 8601'
);

$datePreferenceMigrationMap = array(
	'default',
	'et numeric',
	'dmy',
	'et roman',
);

$defaultDateFormat = 'dmy';

$dateFormats = array(
	'et numeric time' => 'H:i',
	'et numeric date' => 'd.m.Y',
	'et numeric both' => 'd.m.Y, "kell" H:i',

	'dmy time' => 'H:i',
	'dmy date' => 'j. F Y',
	'dmy both' => 'j. F Y, "kell" H:i',

	'et roman time' => 'H:i',
	'et roman date' => 'j. xrm Y',
	'et roman both' => 'j. xrm Y, "kell" H:i',
);

$messages = array(
# User preference toggles
'tog-underline'               => 'Lingid alla kriipsutada',
'tog-highlightbroken'         => 'Vorminda lingirikked <a href="" class="new">nii</a> (alternatiiv: nii<a href="" class="internal">?</a>).',
'tog-justify'                 => 'Lõikude rööpjoondus',
'tog-hideminor'               => 'Peida pisiparandused viimastes muudatustes',
'tog-extendwatchlist'         => 'Laienda jälgimisloendit, et näha kõiki muudatusi, mitte vaid kõige värskemaid',
'tog-usenewrc'                => 'Laiendatud viimased muudatused (nõutav JavaScripti olemasolu)',
'tog-numberheadings'          => 'Pealkirjade automaatnummerdus',
'tog-showtoolbar'             => 'Redigeerimise tööriistariba näitamine',
'tog-editondblclick'          => 'Artiklite redigeerimine topeltklõpsu peale (JavaScript)',
'tog-editsection'             => '[redigeeri] lingid peatükkide muutmiseks',
'tog-editsectiononrightclick' => 'Peatükkide redigeerimine paremklõpsuga alampealkirjadel (JavaScript)',
'tog-showtoc'                 => 'Näita sisukorda (lehtedel, millel on rohkem kui 3 pealkirja)',
'tog-rememberpassword'        => 'Parooli meeldejätmine tulevasteks seanssideks',
'tog-editwidth'               => 'Laienda toimetamisaken ekraani laiuseks',
'tog-watchcreations'          => 'Lisa minu loodud lehed jälgimisloendisse',
'tog-watchdefault'            => 'Jälgi uusi ja muudetud artikleid',
'tog-watchmoves'              => 'Lisa minu teisaldatud artiklid jälgimisloendisse',
'tog-watchdeletion'           => 'Lisa minu kustutatud leheküljed jälgimisloendisse',
'tog-minordefault'            => 'Märgi kõik parandused vaikimisi pisiparandusteks',
'tog-previewontop'            => 'Näita eelvaadet toimetamisakna ees, mitte järel',
'tog-previewonfirst'          => 'Näita eelvaadet esimesel redigeerimisel',
'tog-nocache'                 => 'Keela lehekülgede puhverdamine',
'tog-enotifwatchlistpages'    => 'Teata meili teel, kui minu jälgitavat artiklit muudetakse',
'tog-enotifusertalkpages'     => 'Teata meili teel, kui minu arutelu lehte muudetakse',
'tog-enotifminoredits'        => 'Teata meili teel ka pisiparandustest',
'tog-enotifrevealaddr'        => 'Näita minu e-posti aadressi teatavakstegemiste e-kirjades.',
'tog-shownumberswatching'     => 'Näita jälgivate kasutajate hulka',
'tog-fancysig'                => 'Kasuta vikiteksti vormingus allkirja (ilma automaatse lingita kasutajalehele)',
'tog-externaleditor'          => 'Kasuta vaikimisi välist redaktorit',
'tog-externaldiff'            => 'Kasuta vaikimisi välist võrdlusvahendit (ainult ekspertidele, tarvilikud on kasutaja arvuti eriseadistused)',
'tog-showjumplinks'           => 'Kuva lehekülje ülaservas "mine"-lingid.',
'tog-uselivepreview'          => 'Kasuta elavat eelvaadet (nõutav JavaScript) (testimisel)',
'tog-forceeditsummary'        => 'Nõua redigeerimisel resümee välja täitmist',
'tog-watchlisthideown'        => 'Peida minu redaktsioonid jälgimisloendist',
'tog-watchlisthidebots'       => 'Peida robotid jälgimisloendist',
'tog-watchlisthideminor'      => 'Peida pisiparandused jälgimisloendist',
'tog-ccmeonemails'            => 'Saada mulle koopiad e-mailidest, mida ma teistele kasutajatele saadan',
'tog-diffonly'                => 'Ära näita erinevuste vaate all lehe sisu',
'tog-showhiddencats'          => 'Näita peidetud kategooriaid',

'underline-always'  => 'Alati',
'underline-never'   => 'Mitte kunagi',
'underline-default' => 'Brauseri vaikeväärtus',

'skinpreview' => '(Eelvaade)',

# Dates
'sunday'        => 'pühapäev',
'monday'        => 'esmaspäev',
'tuesday'       => 'teisipäev',
'wednesday'     => 'kolmapäev',
'thursday'      => 'neljapäev',
'friday'        => 'reede',
'saturday'      => 'laupäev',
'sun'           => 'P',
'mon'           => 'E',
'tue'           => 'T',
'wed'           => 'K',
'thu'           => 'N',
'fri'           => 'R',
'sat'           => 'L',
'january'       => 'jaanuar',
'february'      => 'veebruar',
'march'         => 'märts',
'april'         => 'aprill',
'may_long'      => 'mai',
'june'          => 'juuni',
'july'          => 'juuli',
'august'        => 'august',
'september'     => 'september',
'october'       => 'oktoober',
'november'      => 'november',
'december'      => 'detsember',
'january-gen'   => 'jaanuari',
'february-gen'  => 'veebruari',
'march-gen'     => 'märtsi',
'april-gen'     => 'aprilli',
'may-gen'       => 'mai',
'june-gen'      => 'juuni',
'july-gen'      => 'juuli',
'august-gen'    => 'augusti',
'september-gen' => 'septembri',
'october-gen'   => 'oktoobri',
'november-gen'  => 'novembri',
'december-gen'  => 'detsembri',
'jan'           => 'jaan',
'feb'           => 'veebr',
'mar'           => 'märts',
'apr'           => 'apr',
'may'           => 'mai',
'jun'           => 'juuni',
'jul'           => 'juuli',
'aug'           => 'aug',
'sep'           => 'sept',
'oct'           => 'okt',
'nov'           => 'nov',
'dec'           => 'dets',

# Categories related messages
'pagecategories'                 => '{{PLURAL:$1|Kategooria|Kategooriad}}',
'category_header'                => 'Leheküljed kategoorias "$1"',
'subcategories'                  => 'Allkategooriad',
'category-media-header'          => 'Meediafailid kategooriast "$1"',
'category-empty'                 => "''Selles kategoorias pole ühtegi artiklit ega meediafaili.''",
'hidden-categories'              => '{{PLURAL:$1|Peidetud kategooria|Peidetud kategooriad}}',
'hidden-category-category'       => 'Peidetud kategooriad', # Name of the category where hidden categories will be listed
'category-subcat-count'          => '{{PLURAL:$2|Selles kategoorias on ainult järgmine allkategooria.|{{PLURAL:$1|Järgmine allkategooria|Järgmised $1 allkategooriat}} on selles kategoorias (kokku $2).}}',
'category-subcat-count-limited'  => '{{PLURAL:$1|Järgmine allkategooria|Järgmised $1 allkategooriat}} on selles kategoorias.',
'category-article-count'         => '{{PLURAL:$2|Antud kategoorias on ainult järgmine lehekülg.|{{PLURAL:$1|Järgmine lehekülg|Järgmised $1 lehekülge}} on selles kategoorias (kokku $2).}}',
'category-article-count-limited' => '{{PLURAL:$1|Järgmine lehekülg|Järgmised $1 lehekülge}} on selles kategoorias.',
'category-file-count'            => '{{PLURAL:$2|Selles kategoorias on ainult järgmine fail.|{{PLURAL:$1|Järgmine fail |Järgmised $1 faili}} on selles kategoorias (kokku $2).}}',
'category-file-count-limited'    => '{{PLURAL:$1|Järgmine fail|Järgmised $1 faili}} on selles kategoorias.',
'listingcontinuesabbrev'         => 'jätk',

'mainpagetext'      => "<big>'''MediaWiki tarkvara on edukalt paigaldatud.'''</big>",
'mainpagedocfooter' => 'Juhiste saamiseks kasutamise ning konfigureerimise kohta vaata palun inglisekeelset [http://meta.wikimedia.org/wiki/MediaWiki_localisation dokumentatsiooni liidese kohaldamisest]
ning [http://meta.wikimedia.org/wiki/MediaWiki_User%27s_Guide kasutusjuhendit].',

'about'          => 'Tiitelandmed',
'article'        => 'artikkel',
'newwindow'      => '(avaneb uues aknas)',
'cancel'         => 'Loobu',
'qbfind'         => 'Otsi',
'qbbrowse'       => 'Sirvi',
'qbedit'         => 'Redigeeri',
'qbpageoptions'  => 'Lehekülje suvandid',
'qbpageinfo'     => 'Lehekülje andmed',
'qbmyoptions'    => 'Minu suvandid',
'qbspecialpages' => 'Erileheküljed',
'moredotdotdot'  => 'Veel...',
'mypage'         => 'Minu lehekülg',
'mytalk'         => 'Arutelu',
'anontalk'       => 'Arutelu selle IP jaoks',
'navigation'     => 'Navigeerimine',
'and'            => 'ja',

# Metadata in edit box
'metadata_help' => 'Metaandmed:',

'errorpagetitle'    => 'Viga',
'returnto'          => 'Naase lehele $1',
'tagline'           => 'Allikas: {{SITENAME}}',
'help'              => 'Juhend',
'search'            => 'Otsi',
'searchbutton'      => 'Otsi',
'go'                => 'Mine',
'searcharticle'     => 'Mine',
'history'           => 'Artikli ajalugu',
'history_short'     => 'Ajalugu',
'updatedmarker'     => 'uuendatud pärast viimast külastust',
'info_short'        => 'Info',
'printableversion'  => 'Prinditav versioon',
'permalink'         => 'Püsilink',
'print'             => 'Prindi',
'edit'              => 'redigeeri',
'create'            => 'Loo',
'editthispage'      => 'Redigeeri seda artiklit',
'create-this-page'  => 'Loo see lehekülg',
'delete'            => 'kustuta',
'deletethispage'    => 'Kustuta see artikkel',
'undelete_short'    => 'Taasta {{PLURAL:$1|üks muudatus|$1 muudatust}}',
'protect'           => 'Kaitse',
'protect_change'    => 'muuda',
'protectthispage'   => 'Kaitse seda artiklit',
'unprotect'         => 'Ära kaitse',
'unprotectthispage' => 'Ära kaitse seda artiklit',
'newpage'           => 'Uus artikkel',
'talkpage'          => 'Selle artikli arutelu',
'talkpagelinktext'  => 'arutelu',
'specialpage'       => 'Erilehekülg',
'personaltools'     => 'Personaalsed tööriistad',
'postcomment'       => 'Uus alalõik',
'articlepage'       => 'Artiklilehekülg',
'talk'              => 'Arutelu',
'views'             => 'vaatamisi',
'toolbox'           => 'Tööriistad',
'userpage'          => 'Kasutajalehekülg',
'projectpage'       => 'Vaata projektilehekülge',
'imagepage'         => 'Vaata faililehekülge',
'mediawikipage'     => 'Vaata sõnumite lehekülge',
'templatepage'      => 'Mallilehekülg',
'viewhelppage'      => 'Vaata abilehekülge',
'categorypage'      => 'Kategoorialehekülg',
'viewtalkpage'      => 'Arutelulehekülg',
'otherlanguages'    => 'Teistes keeltes',
'redirectedfrom'    => '(Ümber suunatud leheküljelt $1)',
'redirectpagesub'   => 'Ümbersuunamisleht',
'lastmodifiedat'    => 'Viimane muutmine: $2, $1', # $1 date, $2 time
'viewcount'         => 'Seda lehekülge on külastatud {{PLURAL:$1|üks kord|$1 korda}}.',
'protectedpage'     => 'Kaitstud lehekülg',
'jumpto'            => 'Mine:',
'jumptonavigation'  => 'navigeerimiskast',
'jumptosearch'      => 'otsi',

# All link text and link target definitions of links into project namespace that get used by other message strings, with the exception of user group pages (see grouppage) and the disambiguation template definition (see disambiguations).
'aboutsite'            => '{{SITENAME}} tiitelandmed',
'aboutpage'            => 'Project:Tiitelandmed',
'bugreports'           => 'Teated programmivigadest',
'bugreportspage'       => 'Project:Teated_programmivigadest',
'copyright'            => 'Kogu tekst on kasutatav litsentsi $1 tingimustel.',
'copyrightpagename'    => '{{SITENAME}} ja autoriõigused',
'copyrightpage'        => '{{ns:project}}:Autoriõigused',
'currentevents'        => 'Sündmused maailmas',
'currentevents-url'    => 'Project:Sündmused maailmas',
'disclaimers'          => 'Hoiatused',
'disclaimerpage'       => 'Project:Hoiatused',
'edithelp'             => 'Redigeerimisjuhend',
'edithelppage'         => 'Help:Kuidas_lehte_redigeerida',
'faq'                  => 'KKK',
'faqpage'              => 'Project:KKK',
'helppage'             => 'Help:Juhend',
'mainpage'             => 'Esileht',
'mainpage-description' => 'Esileht',
'policy-url'           => 'Project:Reeglid',
'portal'               => 'Kogukonnavärav',
'portal-url'           => 'Project:Kogukonnavärav',
'privacy'              => 'Privaatsus',
'privacypage'          => 'Project:Privaatsus',

'badaccess'        => 'Õigus puudub',
'badaccess-group0' => 'Sul ei ole õigust läbi viia toimingut, mida üritasid.',
'badaccess-group1' => 'Soovitud toiming on lubatud vaid kasutajatele rühmas $1.',
'badaccess-group2' => 'Soovitud toiming on lubatud vaid kasutajatele rühmades $1.',
'badaccess-groups' => 'Soovitud toiming on lubatud vaid kasutajatele rühmades $1.',

'versionrequired'     => 'Nõutav MediaWiki versioon $1',
'versionrequiredtext' => 'Selle lehe kasutamiseks on nõutav MediaWiki versioon $1.
Vaata [[Special:Version|versiooni lehekülge]].',

'ok'                      => 'Sobib',
'retrievedfrom'           => 'Välja otsitud andmebaasist "$1"',
'youhavenewmessages'      => 'Teile on $1 ($2).',
'newmessageslink'         => 'uusi sõnumeid',
'newmessagesdifflink'     => 'viimane muudatus',
'youhavenewmessagesmulti' => 'Sulle on uusi sõnumeid $1',
'editsection'             => 'redigeeri',
'editsection-brackets'    => '[$1]',
'editold'                 => 'redigeeri',
'viewsourceold'           => 'vaata lähteteksti',
'editsectionhint'         => 'Redigeeri alaosa $1',
'toc'                     => 'Sisukord',
'showtoc'                 => 'näita',
'hidetoc'                 => 'peida',
'thisisdeleted'           => 'Vaata või taasta $1?',
'viewdeleted'             => 'Vaata lehekülge $1?',
'restorelink'             => '{{PLURAL:$1|üks kustutatud versioon|$1 kustutatud versiooni}}',
'feedlinks'               => 'Sööde:',
'site-rss-feed'           => '$1 RSS-toide',
'site-atom-feed'          => '$1 Atom-toide',
'page-rss-feed'           => '"$1" RSS-toide',
'page-atom-feed'          => '"$1" Atom-toide',
'red-link-title'          => '$1 (pole veel kirjutatud)',

# Short words for each namespace, by default used in the namespace tab in monobook
'nstab-main'      => 'Artikkel',
'nstab-user'      => 'Kasutaja leht',
'nstab-media'     => 'Meedia',
'nstab-special'   => 'Eri',
'nstab-project'   => 'Abileht',
'nstab-image'     => 'Pilt',
'nstab-mediawiki' => 'Sõnum',
'nstab-template'  => 'Mall',
'nstab-help'      => 'Juhend',
'nstab-category'  => 'Kategooria',

# Main script and global functions
'nosuchaction'      => 'Sellist toimingut pole.',
'nosuchactiontext'  => 'Viki ei tunne internetiaadressile vastavat tegevust.
Võimalik, et sa sisestasid aadressi valesti või kasutasid vigast linki.
Samuti ei ole välistatud, et tarkvaras, mida {{SITENAME}} kasutatab, on viga.',
'nosuchspecialpage' => 'Sellist erilehekülge pole.',
'nospecialpagetext' => 'Viki ei tunne sellist erilehekülge.',

# General errors
'error'                => 'Viga',
'databaseerror'        => 'Andmebaasi viga',
'dberrortext'          => 'Andmebaasipäringus oli süntaksiviga.
Selle võis tingida tarkvaraviga.
Viimane andmebaasipäring oli:
<blockquote><tt>$1</tt></blockquote>
ja see kutsuti funktsioonist "<tt>$2</tt>".
Andmebaas tagastas veateate "<tt>$3: $4</tt>".',
'dberrortextcl'        => 'Andmebaasipäringus oli süntaksiviga.
Viimane andmebaasipäring oli:
"$1"
ja see kutsuti funktsioonist "$2".
Andmebaas tagastas veateate "$3: $4".',
'noconnect'            => 'Vabandame! Vikil on tehnilisi probleeme ning ei saa andmebaasiserveriga $1 ühendust.',
'nodb'                 => 'Andmebaasi $1 ei õnnestunud kätte saada',
'cachederror'          => 'Järgnev tekst pärineb serveri vahemälust ega pruugi olla lehekülje viimane versioon.',
'laggedslavemode'      => 'Hoiatus: Leheküljel võivad puududa viimased uuendused.',
'readonly'             => 'Andmebaas on hetkel kirjutuskaitse all',
'enterlockreason'      => 'Sisesta lukustamise põhjus ning juurdepääsu taastamise ligikaudne aeg',
'readonlytext'         => 'Andmebaas on praegu kirjutuskaitse all, tõenäoliselt andmebaasi harjumuslikuks hoolduseks, mille lõppedes tavaline olukord taastub.
Ülem, kes selle kaitse alla võttis, andis järgmise selgituse:
<p>$1',
'missing-article'      => 'Andmebaas ei leidnud küsitud lehekülje "$1" $2 teksti.

Põhjuseks võib olla võrdlus- või ajaloolink kustutatud leheküljele.

Kui tegemist ei ole nimetatud olukorraga, võib tegu olla ka süsteemi veaga.
Sellisel juhul tuleks teavitada [[Special:ListUsers/sysop|ülemat]], edastades talle ka käesoleva lehe internetiaadressi.',
'missingarticle-rev'   => '(redaktsioon: $1)',
'missingarticle-diff'  => '(redaktsioonid: $1, $2)',
'internalerror'        => 'Sisemine viga',
'internalerror_info'   => 'Sisemine viga: $1',
'filecopyerror'        => 'Ei saanud faili "$1" kopeerida nimega "$2".',
'filerenameerror'      => 'Ei saanud faili "$1" failiks "$2" ümber nimetada.',
'filedeleteerror'      => 'Faili nimega "$1" ei ole võimalik kustutada.',
'directorycreateerror' => 'Ei suuda luua kausta "$1".',
'filenotfound'         => 'Faili nimega "$1" ei leitud.',
'fileexistserror'      => 'Kirjutamine faili "$1" ebaõnnestus: fail on juba olemas',
'unexpected'           => 'Ootamatu väärtus: "$1"="$2".',
'formerror'            => 'Viga: vormi ei saanud salvestada',
'badarticleerror'      => 'Seda toimingut ei saa sellel leheküljel sooritada.',
'cannotdelete'         => 'Seda lehekülge või pilti ei ole võimalik kustutada. (Võib-olla keegi teine juba kustutas selle.)',
'badtitle'             => 'Vigane pealkiri',
'badtitletext'         => 'Soovitud leheküljepealkiri oli vigane, tühi või teisest keeleversioonist või vikist valesti lingitud.
See võib sisaldada ühte või enamat märki, mida ei saa pealkirjades kasutada.',
'perfdisabled'         => 'Vabandage! See funktsioon ajutiselt ei tööta, sest ta aeglustab andmebaasi kasutamist võimatuseni. Sellepärast täiustatakse vastavat programmi lähitulevikus. Võib-olla teete seda Teie!',
'perfcached'           => 'Järgnevad andmed on puhverdatud ja ei pruugi olla kõige värskemad:',
'perfcachedts'         => 'Järgmised andmed on vahemälus. Viimase uuendamise daatum on $1.',
'querypage-no-updates' => 'Lehekülje uuendamine ei ole hetkel lubatud ning andmeid ei värskendata.',
'wrong_wfQuery_params' => 'Valed parameeterid funktsioonile wfQuery()<br />
Funktsioon: $1<br />
Päring: $2',
'viewsource'           => 'Vaata lähteteksti',
'viewsourcefor'        => '$1',
'actionthrottled'      => 'Toiming nurjus',
'actionthrottledtext'  => 'Rämpsmuudatuste vastase meetmena pole sul lühikse aja jooksul seda toimingut liiga palju kordi lubatud sooritada. Sa oled lühikse aja jooskul seda toimingut liiga palju kordi sooritanud.
Palun proovi mõne minuti pärast uuesti.',
'protectedpagetext'    => 'See lehekülg on lukustatud, et muudatusi ei tehtaks.',
'viewsourcetext'       => 'Võite vaadata ja kopeerida lehekülje algteksti:',
'protectedinterface'   => 'Sellel leheküljel on tarkvara kasutajaliidese tekst. Kuritahtliku muutmise vältimiseks on lehekülg lukustatud.',
'editinginterface'     => "'''Hoiatus:''' Te redigeerite tarkvara kasutajaliidese tekstiga lehekülge. Muudatused siin mõjutavad kõikide kasutajate kasutajaliidest. Tõlkijad, palun kaaluge MediaWiki tõlkimisprojekti – [http://translatewiki.net/wiki/Main_Page?setlang=et translatewiki.net] kasutamist.",
'sqlhidden'            => '(SQL päring peidetud)',
'cascadeprotected'     => 'See lehekülg on muutmise eest kaitstud, sest see on osa {{PLURAL:$1|järgmisest leheküljest|järgmistest lehekülgedest}}, mis on kaskaadkaitse all:
$2',
'namespaceprotected'   => "Teil ei ole õigusi redigeerida lehekülgi '''$1''' nimeruumis.",
'customcssjsprotected' => 'Sul pole õigust antud lehte muuta, kuna see sisaldab teise kasutaja isiklikke seadeid.',
'ns-specialprotected'  => 'Erilehekülgi ei saa redigeerida.',
'titleprotected'       => "Kasutaja [[User:$1|$1]] on selle pealkirjaga lehe loomise keelanud esitades järgmise põhjenduse: ''$2''.",

# Virus scanner
'virus-badscanner'     => "Viga konfiguratsioonis: tundmatu viirusetõrje: ''$1''",
'virus-scanfailed'     => 'skaneerimine ebaõnnestus (veakood $1)',
'virus-unknownscanner' => 'tundmatu viirusetõrje:',

# Login and logout pages
'logouttitle'                => 'Väljalogimine',
'logouttext'                 => "'''Te olete nüüd välja loginud.'''

Te võite jätkata {{SITENAME}} kasutamist anonüümselt, aga ka sama või mõne teise kasutajana uuesti [[Special:UserLogin|sisse logida]].",
'welcomecreation'            => '<h2>Tere tulemast, $1!</h2><p>Teie konto on loodud. Ärge unustage seada oma eelistusi.',
'loginpagetitle'             => 'Sisselogimine',
'yourname'                   => 'Teie kasutajanimi',
'yourpassword'               => 'Teie parool',
'yourpasswordagain'          => 'Sisestage parool uuesti',
'remembermypassword'         => 'Parooli meeldejätmine tulevasteks seanssideks.',
'yourdomainname'             => 'Teie domeen:',
'loginproblem'               => '<b>Sisselogimine ei õnnestunud.</b><br />Proovige uuesti!',
'login'                      => 'Logi sisse',
'nav-login-createaccount'    => 'Logi sisse / registreeru kasutajaks',
'loginprompt'                => 'Teie brauser peab nõustuma küpsistega, et saaksite {{SITENAME}} lehele sisse logida.',
'userlogin'                  => 'Logi sisse / registreeru kasutajaks',
'logout'                     => 'Logi välja',
'userlogout'                 => 'Logi välja',
'notloggedin'                => 'Te pole sisse loginud',
'nologin'                    => 'Sul pole kontot? $1.',
'nologinlink'                => 'Registreeru siin',
'createaccount'              => 'Loo uus konto',
'gotaccount'                 => 'Kui sul on juba konto olemas, siis $1.',
'gotaccountlink'             => 'logi sisse',
'createaccountmail'          => 'meili teel',
'badretype'                  => 'Sisestatud paroolid ei lange kokku.',
'userexists'                 => 'Sisestatud kasutajanimi on juba kasutusel.
Palun valige uus nimi.',
'youremail'                  => 'Teie e-posti aadress*',
'username'                   => 'Kasutajanimi:',
'uid'                        => 'Kasutaja ID:',
'prefs-memberingroups'       => 'Kuulub {{PLURAL:$1|rühma|rühmadesse}}:',
'yourrealname'               => 'Tegelik nimi:',
'yourlanguage'               => 'Keel:',
'yournick'                   => 'Teie hüüdnimi (allakirjutamiseks)',
'badsig'                     => 'Sobimatu allkiri.
Palun kontrolli HTML koodi.',
'badsiglength'               => 'Sinu signatuur on liiga pikk.
See ei tohi olla pikem kui $1 {{PLURAL:$1|sümbol|sümbolit}}.',
'email'                      => 'E-post',
'prefs-help-realname'        => 'Vabatahtlik: Kui otsustate selle avaldada, kasutatakse seda teie kaastöö seostamiseks teiega.',
'loginerror'                 => 'Viga sisselogimisel',
'prefs-help-email'           => 'Elektronpostiaadressi sisestamine ei ole kohustuslik, kuid võimaldab sul tellida parooli meeldetuletuse, kui peaksid oma parooli unustama. Samuti saad aadressi märkides anda oma identiteeti avaldamata teistele kasutajatele võimaluse enesele sõnumeid saata.',
'prefs-help-email-required'  => 'E-posti aadress on vajalik.',
'nocookiesnew'               => 'Kasutajakonto loodi, aga sa ei ole sisse logitud, sest {{SITENAME}} kasutab kasutajate tuvastamisel küpsiseid. Sinu brauseris on küpsised keelatud. Palun sea küpsised lubatuks ja logi siis oma vastse kasutajanime ning parooliga sisse.',
'nocookieslogin'             => '{{SITENAME}} kasutab kasutajate tuvastamisel küpsiseid. Sinu brauseris on küpsised keelatud. Palun sea küpsised lubatuks ja proovi siis uuesti.',
'noname'                     => 'Sa ei sisestanud kasutajanime lubataval kujul.',
'loginsuccesstitle'          => 'Sisselogimine õnnestus',
'loginsuccess'               => 'Te olete sisse loginud. Teie kasutajanimi on "$1".',
'nosuchuser'                 => 'Kasutajat "$1" ei ole olemas.
Kasutajanimed on tõstutundlikud.
Kontrollige kirjapilti või [[Special:UserLogin/signup|looge uus kasutajakonto]].',
'nosuchusershort'            => 'Kasutajat nimega "<nowiki>$1</nowiki>" ei ole olemas. Kontrollige kirjapilti.',
'nouserspecified'            => 'Kasutajanimi puudub.',
'wrongpassword'              => 'Vale parool. Proovige uuesti.',
'wrongpasswordempty'         => 'Parool jäi sisestamata. Palun proovi uuesti.',
'passwordtooshort'           => 'Sisestatud parool on vigane või liiga lühike. See peab koosnema vähemalt {{PLURAL:$1|ühest|$1}} tähemärgist ning peab erinema kasutajanimest.',
'mailmypassword'             => 'Saada mulle meili teel uus parool',
'passwordremindertitle'      => '{{SITENAME}} - unustatud salasõna',
'passwordremindertext'       => 'Keegi (tõenäoliselt Teie ise, IP-aadressilt $1),
palus, et me saadaksime Teile uue parooli {{SITENAME}} sisselogimiseks ($4).
Kasutaja "$2" parool on nüüd "$3".
Kui see oli Teie kavatsus, te peaksite sisse logida ja selle ajutise parooli ära muuta.

Kui keegi teine tegi parooli muutmise nõude, või kui Te mäletate oma vana parooli ja
Te enam ei soovi parooli muuta, siis võite ignoreerida seda sõnumit ja jätkata vana parooli kasutamist',
'noemail'                    => 'Kasutaja "$1" meiliaadressi meil kahjuks pole.',
'passwordsent'               => 'Uus parool on saadetud kasutaja "$1" registreeritud meiliaadressil.
Pärast parooli saamist logige palun sisse.',
'blocked-mailpassword'       => 'Sinu IP-aadressi jaoks on toimetamine blokeeritud, seetõttu ei saa sa kasutada ka parooli meeldetuletamise funktsiooni.',
'eauthentsent'               => 'Sisestatud e-posti aadressile on saadetud kinnituse e-kiri.
Enne kui su kontole ükskõik milline muu e-kiri saadetakse, pead sa e-kirjas olevat juhist järgides kinnitama, et konto on tõepoolest sinu.',
'throttled-mailpassword'     => 'Parooli meeldetuletus lähetatud viimase {{PLURAL:$1|tunni|$1 tunni}} jooksul.
Väärtarvitamise vältimiseks saadetakse {{PLURAL:$1|tunni|$1 tunni}} jooksul ainult üks meeldetuletus.',
'mailerror'                  => 'Viga kirja saatmisel: $1',
'acct_creation_throttle_hit' => 'Vabandame, aga te olete loonud juba $1 kontot. Rohkem te ei saa.',
'emailauthenticated'         => 'Sinu e-posti aadress kinnitati $1.',
'emailnotauthenticated'      => 'Sinu e-posti aadress <strong>pole veel kinnitatud</strong>. E-posti kinnitamata aadressile ei saadeta.',
'noemailprefs'               => 'Järgnevate võimaluste toimimiseks on vaja sisestada e-posti aadress.',
'emailconfirmlink'           => 'Kinnita oma e-posti aadress',
'invalidemailaddress'        => 'E-aadress ei ole aktsepteeritav, sest see on vigaselt kirjutatud.
Ole hea ja anna õige e-aadress või jäta lahter tühjaks.',
'accountcreated'             => 'Konto loodud',
'accountcreatedtext'         => 'Kasutajakonto kasutajatunnusele $1 loodud.',
'createaccount-title'        => 'Konto loomine portaali {{SITENAME}}',
'createaccount-text'         => 'Keegi on loonud {{GRAMMAR:illative|{{SITENAME}}}} ($4) sinu meiliaadressile vastava kasutajatunnuse "$2". Parooliks seati "$3". Logi sisse ja muuda oma parool.

Kui kasutajakonto loomine on eksitus, võid käesolevat sõnumit lihtsalt ignoreerida.',
'loginlanguagelabel'         => 'Keel: $1',

# Password reset dialog
'resetpass'               => 'Konto salasõna lähtestamine',
'resetpass_announce'      => 'Sa logisid sisse ajutise e-maili koodiga. 
Et sisselogimine lõpetada, pead uue parooli siia trükkima:',
'resetpass_text'          => '<!-- Lisa tekst siia -->',
'resetpass_header'        => 'Muuda konto parooli',
'resetpass_submit'        => 'Sisesta parool ja logi sisse',
'resetpass_success'       => 'Sinu parool on edukalt muudetud! Sisselogimine...',
'resetpass_bad_temporary' => 'Vale ajutine parool.

Sa võid olla juba edukalt muutnud oma parooli või küsinud uue ajutise parooli.',
'resetpass_forbidden'     => 'Paroole ei saa muuta',

# Edit page toolbar
'bold_sample'     => 'Rasvane kiri',
'bold_tip'        => 'Rasvane kiri',
'italic_sample'   => 'Kaldkiri',
'italic_tip'      => 'Kaldkiri',
'link_sample'     => 'Lingitav pealkiri',
'link_tip'        => 'Siselink',
'extlink_sample'  => 'http://www.example.com Lingi nimi',
'extlink_tip'     => 'Välislink (ärge unustage kasutada http:// eesliidet)',
'headline_sample' => 'Pealkiri',
'headline_tip'    => '2. taseme pealkiri',
'math_sample'     => 'Sisesta valem siia',
'math_tip'        => 'Matemaatiline valem (LaTeX)',
'nowiki_sample'   => 'Sisesta vormindamata tekst',
'nowiki_tip'      => 'Ignoreeri viki vormindust',
'image_sample'    => 'Näidis.jpg',
'image_tip'       => 'Pilt',
'media_sample'    => 'Näidis.ogg',
'media_tip'       => 'Link failile',
'sig_tip'         => 'Sinu allkiri ajatempliga',
'hr_tip'          => 'Horisontaalkriips (kasuta säästlikult)',

# Edit pages
'summary'                          => 'Resümee',
'subject'                          => 'Pealkiri',
'minoredit'                        => 'See on pisiparandus',
'watchthis'                        => 'Jälgi seda artiklit',
'savearticle'                      => 'Salvesta',
'preview'                          => 'Eelvaade',
'showpreview'                      => 'Näita eelvaadet',
'showlivepreview'                  => 'Näita eelvaadet',
'showdiff'                         => 'Näita muudatusi',
'anoneditwarning'                  => 'Te ei ole sisse logitud. Selle lehe redigeerimislogisse salvestatakse Teie IP-aadress.',
'missingsummary'                   => "'''Meeldetuletus:''' Sa ei ole lisanud muudatuse resümeed.
Kui vajutad uuesti salvestamise nupule, salvestatakse muudatus ilma resümeeta.",
'missingcommenttext'               => 'Palun sisesta siit allapoole kommentaar.',
'missingcommentheader'             => "'''Meeldetuletus:''' Sa ei ole kirjutanud kommentaarile teemat/pealkirja.
Kui vajutad uuesti <em>Salvesta</em>, siis salvestatakse kommentaar ilma teema/pealkirjata.",
'summary-preview'                  => 'Resümee eelvaade',
'subject-preview'                  => 'Pealkirja eelvaade',
'blockedtitle'                     => 'Kasutaja on blokeeritud',
'blockedtext'                      => "<big>'''Teie kasutajanimi või IP-aadress on blokeeritud.'''</big>

Blokeeris $1.
Tema põhjendus on järgmine: ''$2''.

* Blokeeringu algus: $8
* Blokeeringu lõpp: $6
* Sooviti blokeerida: $7

Küsimuse arutamiseks võite pöörduda kasutaja $1 või mõne teise [[{{MediaWiki:Grouppage-sysop}}|administraatori]] poole.

Pange tähele, et Te ei saa kasutajale teadet saata, kui Te pole kinnitanud oma [[Special:Preferences|eelistuste lehel]] kehtivat e-posti aadressi.

Teie praegune IP-aadress on $3 ning blokeeringu number on #$5. Lisage need andmed kõigile järelepärimistele, mida kavatsete teha.",
'autoblockedtext'                  => "Teie IP-aadress blokeeriti automaatselt, sest seda kasutas teine kasutaja, kelle $1 blokeeris.
Põhjendus on järgmine:

:''$2''

* Blokeeringu algus: $8
* Blokeeringu lõpp: $6
* Sooviti blokeerida: $7

Küsimuse arutamiseks võite pöörduda kasutaja $1 või mõne teise [[{{MediaWiki:Grouppage-sysop}}|administraatori]] poole.

Pange tähele, et Te ei saa teisele kasutajale teadet saata, kui Te pole kinnitanud oma [[Special:Preferences|eelistuste lehel]] kehtivat e-posti aadressi ega ole selle kasutamisest blokeeritud.

Teie praegune IP on $3 ning blokeeringu number on #$5. Lisage need andmed kõigile järelpärimistele, mida kavatsete teha.",
'blockednoreason'                  => 'põhjendust ei ole kirja pandud',
'blockedoriginalsource'            => "'''$1''' allikas on näidatud allpool:",
'blockededitsource'                => "Sinu muudatused leheküljele '''$1''':",
'whitelistedittitle'               => 'Redigeerimiseks tuleb sisse logida',
'whitelistedittext'                => 'Lehekülgede toimetamiseks peate $1.',
'confirmedittitle'                 => 'E-posti kinnitus on vajalik toimetamiseks',
'confirmedittext'                  => 'Lehekülgi ei saa toimetada enne e-aadressi kinnitamist. Võid teha kinnitamise [[Special:Preferences|eelistuste lehel]].',
'nosuchsectiontitle'               => 'Sellist alaosa pole',
'nosuchsectiontext'                => 'Sa üritasid redigeerida alaosa, mida ei ole. Kuna alaosa $1 pole, ei saa redaktsiooni salvestada.',
'loginreqtitle'                    => 'Vajalik on sisselogimine',
'loginreqlink'                     => 'sisse logima',
'loginreqpagetext'                 => 'Lehekülgede vaatamiseks peate $1.',
'accmailtitle'                     => 'Parool saadetud.',
'accmailtext'                      => "Kasutaja '$1' parool saadeti aadressile $2.",
'newarticle'                       => '(Uus)',
'newarticletext'                   => "Sellise pealkirjaga lehekülge ei ole veel loodud. Lehekülje loomiseks sisestage lehe tekst alljärgnevasse tekstikasti ja salvestage (lisainfo saamiseks vaadake [[{{MediaWiki:Helppage}}|juhendit]]).

Kui sattusite siia kogemata, klõpsake lihtsalt brauseri ''tagasi''-nupule.",
'anontalkpagetext'                 => "---- ''See on arutelulehekülg anonüümse kasutaja jaoks, kes ei ole loonud kontot või ei kasuta seda. Sellepärast tuleb meil kasutaja identifitseerimiseks kasutada tema IP-aadressi.
Sellisel IP-aadressilt võib portaali kasutada mitu inimest.
Kui oled osutatud IP kasutaja ning leiad, et siinsed kommentaarid ei puutu kuidagi sinusse, siis palun [[Special:UserLogin|loo konto või logi sisse]], et sind edaspidi teiste anonüümsete kasutajatega segi ei aetaks.''",
'noarticletext'                    => 'Käesoleval leheküljel hetkel teksti ei ole.
Võid [[Special:Search/{{PAGENAME}}|otsida pealkirjaks olevat fraasi]] teistelt lehtedelt,
<span class="plainlinks">[{{fullurl:Special:Log|page={{urlencode:{{FULLPAGENAME}}}}}} uurida asjassepuutuvaid logisid] või [{{fullurl:{{FULLPAGENAME}}|action=edit}} puuduva lehekülje ise luua]</span>.',
'userpage-userdoesnotexist'        => 'Kasutajakontot "$1" pole olemas.
Palun mõtle järele, kas soovid seda lehte luua või muuta.',
'clearyourcache'                   => "'''Märkus:''' Pärast salvestamist pead sa muudatuste nägemiseks oma brauseri puhvri tühjendama: '''Mozilla:''' ''ctrl-shift-r'', '''IE:''' ''ctrl-f5'', '''Safari:''' ''cmd-shift-r'', '''Konqueror''' ''f5''.",
'usercssjsyoucanpreview'           => "'''Vihje:''' Kasuta nuppu 'Näita eelvaadet' oma uue css/js testimiseks enne salvestamist.",
'usercsspreview'                   => "'''Ärge unustage, et seda versiooni teie isiklikust stiililehest pole veel salvestatud!'''",
'userjspreview'                    => "'''Ärge unustage, et see versioon teie isiklikust javascriptist on alles salvestamata!'''",
'userinvalidcssjstitle'            => "'''Hoiatus:''' Kujundust nimega \"\$1\" ei ole.
Ära unusta, et kasutaja isiklikud .css- ja .js-lehed kasutavad väiketähega algavaid nimesid, näiteks  {{ns:user}}:Juhan Julm/monobook.css ja mitte {{ns:user}}:Juhan Julm/Monobook.css.",
'updated'                          => '(Värskendatud)',
'note'                             => "'''Meeldetuletus:'''",
'previewnote'                      => "'''Ärge unustage, et see versioon ei ole veel salvestatud!'''",
'previewconflict'                  => 'See eelvaade näitab, kuidas ülemises toimetuskastis olev tekst hakkab välja nägema, kui otsustate salvestada.',
'session_fail_preview'             => "'''Vabandust! Meil ei õnnestunud seansiandmete kaotuse tõttu sinu muudatust töödelda.'''
Palun proovi uuesti.
Kui see ikka ei tööta, proovi [[Special:UserLogout|välja]] ja tagasi sisse logida.",
'session_fail_preview_html'        => "'''Vabandust! Meil ei õnnestunud seansiandmete kaotuse tõttu sinu muudatust töödelda.'''

''Kuna võrgukohas {{SITENAME}} on toor-HTML lubatud, on eelvaade JavaScripti rünnakute vastase ettevaatusabinõuna peidetud.''

'''Kui see on õigustatud redigeerimiskatse, proovi palun uuesti.'''
Kui see ikka ei tööta, proovi [[Special:UserLogout|välja]] ja tagasi sisse logida.",
'editing'                          => 'Redigeerimisel on $1',
'editingsection'                   => 'Redigeerimisel on osa leheküljest $1',
'editingcomment'                   => 'Muutmisel on $1 (uus alaosa)',
'editconflict'                     => 'Redigeerimiskonflikt: $1',
'explainconflict'                  => 'Keegi teine on muutnud seda lehekülge pärast seda, kui Teie seda redigeerima hakkasite.
Ülemine toimetuskast sisaldab teksti viimast versiooni.
Teie muudatused on alumises kastis.
Teil tuleb need viimasesse versiooni üle viia.
Kui Te klõpsate nupule
 "Salvesta", siis salvestub <b>ainult</b> ülemises toimetuskastis olev tekst.<br />',
'yourtext'                         => 'Teie tekst',
'storedversion'                    => 'Salvestatud redaktsioon',
'nonunicodebrowser'                => "'''HOIATUS: Sinu brauser ei toeta unikoodi.'''
Probleemist möödahiilimiseks, selleks et saaksid lehekülgi turvaliselt redigeerida, näidatakse mitte-ASCII sümboleid toimetuskastis kuueteistkümnendsüsteemi koodidena.",
'editingold'                       => "'''ETTEVAATUST! Te redigeerite praegu selle lehekülje vana redaktsiooni.
Kui Te selle salvestate, siis lähevad kõik vahepealsed muudatused kaduma.'''",
'yourdiff'                         => 'Erinevused',
'copyrightwarning'                 => "Pidage silmas, et kogu teie kaastöö võrgukohale {{SITENAME}} loetakse avaldatuks litsentsi $2 all (vaata ka $1). Kui te ei soovi, et teie kirjutatut halastamatult redigeeritakse ja oma äranägemise järgi kasutatakse, siis ärge seda siia salvestage.<br />
Te kinnitate ka, et kirjutasite selle ise või võtsite selle kopeerimiskitsenduseta allikast.<br />
'''ÄRGE SAATKE AUTORIÕIGUSEGA KAITSTUD MATERJALI ILMA LOATA!'''",
'copyrightwarning2'                => "Pidage silmas teised kaastöölised võivad kogu võrgukohale {{SITENAME}} tehtud kaastööd muuta või eemaldada. Kui te ei soovi, et teie kirjutatut halastamatult redigeeritakse, siis ärge seda siia salvestage.<br />
Te kinnitate ka, et kirjutasite selle ise või võtsite selle kopeerimiskitsenduseta allikast (vaata ka $1).<br />
'''ÄRGE SAATKE AUTORIÕIGUSEGA KAITSTUD MATERJALI ILMA LOATA!'''",
'longpagewarning'                  => "'''HOIATUS: Selle lehekülje pikkus ületab $1 kilobaiti. Mõne brauseri puhul valmistab raskusi juba 32-le kilobaidile läheneva pikkusega lehekülgede redigeerimine. Palun kaaluge selle lehekülje sisu jaotamist lühemate lehekülgede vahel.'''",
'longpageerror'                    => "'''Viga: Lehekülje suurus on $1 kilobaiti. Lehekülge ei saa salvestada, kuna see on pikem kui maksimaalsed $2 kilobaiti.'''",
'readonlywarning'                  => '<strong>HOIATUS: Andmebaas on lukustatud hooldustöödeks, nii et praegu ei saa parandusi salvestada. Võite teksti alal hoida tekstifailina ning salvestada hiljem.</strong>',
'protectedpagewarning'             => "'''HOIATUS: See lehekülg on lukustatud, nii et seda saavad redigeerida ainult ülema õigustega kasutajad.'''",
'semiprotectedpagewarning'         => "'''Märkus:''' See lehekülg on lukustatud nii, et üksnes registreeritud kasutajad saavad seda muuta.",
'cascadeprotectedwarning'          => "'''Hoiatus:''' See lehekülg on nii lukustatud, et ainult ülema õigustega kasutajad saavad seda redigeerida, sest lehekülg on osa {{PLURAL:$1|järgmisest|järgmisest}} kaskaadkaitsega {{PLURAL:$1|leheküljest|lehekülgedest}}:",
'titleprotectedwarning'            => "'''Hoiatus: See lehekülg on nii lukustatud, et selle loomiseks on tarvis [[Special:ListGroupRights|eriõigusi]].'''",
'templatesused'                    => 'Sellel lehel on kasutusel järgnevad mallid:',
'templatesusedpreview'             => 'Selles eelvaates kasutatakse järgmisi malle:',
'templatesusedsection'             => 'Siin rubriigis kasutatud mallid:',
'template-protected'               => '(kaitstud)',
'template-semiprotected'           => '(osaliselt kaitstud)',
'hiddencategories'                 => 'See lehekülg kuulub {{PLURAL:$1|1 peidetud kategooriasse|$1 peidetud kategooriasse}}:',
'nocreatetitle'                    => 'Lehekülje loomine piiratud',
'nocreatetext'                     => 'Võrgukohas {{SITENAME}} on piirangud uue lehekülje loomisel.
Te võite pöörduda tagasi ja toimetada olemasolevat lehekülge või [[Special:UserLogin|sisse logida või uue konto luua]].',
'nocreate-loggedin'                => 'Sul ei ole luba luua uusi lehekülgi.',
'permissionserrors'                => 'Viga õigustes',
'permissionserrorstext'            => 'Teil ei ole õigust seda teha {{PLURAL:$1|järgmisel põhjusel|järgmistel põhjustel}}:',
'permissionserrorstext-withaction' => 'Sul pole lubatud {{lcfirst:$2}} {{PLURAL:$1|järgneval põhjusel|järgnevatel põhjustel}}:',
'recreate-deleted-warn'            => "'''Hoiatus: Te loote uuesti lehte, mis on varem kustutatud.'''

Kaaluge, kas lehe uuesti loomine on kohane.
Lehe eelnevad kustutamised:",

# Parser/template warnings
'post-expand-template-argument-category' => 'Malli vahele jäetud argumente sisaldavad leheküljed',

# "Undo" feature
'undo-success' => 'Selle redaktsiooni käigus tehtud muudatusi saab eemaldada. Palun kontrolli allolevat võrdlust veendumaks, et tahad need muudatused tõepoolest eemaldada. Seejärel saad lehekülje salvestada.',
'undo-norev'   => 'Muudatust ei saanud tühistada, kuna seda ei ole või see kustutati.',
'undo-summary' => 'Tühistati muudatus $1, mille tegi [[Special:Contributions/$2|$2]] ([[User talk:$2|arutelu]])',

# Account creation failure
'cantcreateaccounttitle' => 'Ei saa kontot luua',
'cantcreateaccount-text' => "Kasutaja [[User:$3|$3]] on blokeerinud kasutajanime loomise sellelt IP-aadressilt ('''$1'''). 
Kasutaja $3 märkis põhjuseks ''$2''",

# History pages
'viewpagelogs'        => 'Vaata selle lehe logisid',
'nohistory'           => 'Sellel leheküljel ei ole eelmisi redaktsioone.',
'revnotfound'         => 'Redaktsiooni ei leitud',
'revnotfoundtext'     => 'Teie poolt päritud vana redaktsiooni ei leitud.
Palun kontrollige aadressi, millel Te seda lehekülge leida püüdsite.',
'currentrev'          => 'Viimane redaktsioon',
'revisionasof'        => 'Redaktsioon: $1',
'revision-info'       => 'Redaktsioon seisuga $1 kasutajalt $2',
'previousrevision'    => '←Vanem redaktsioon',
'nextrevision'        => 'Uuem redaktsioon→',
'currentrevisionlink' => 'vaata viimast redaktsiooni',
'cur'                 => 'viim',
'next'                => 'järg',
'last'                => 'eel',
'page_first'          => 'esimene',
'page_last'           => 'viimane',
'histlegend'          => 'Märgi versioonid, mida tahad võrrelda ja vajuta võrdlemisnupule.
Legend: (viim) = erinevused võrreldes viimase redaktsiooniga,
(eel) = erinevused võrreldes eelmise redaktsiooniga, P = pisimuudatus',
'deletedrev'          => '[kustutatud]',
'histfirst'           => 'Esimesed',
'histlast'            => 'Viimased',
'historysize'         => '({{PLURAL:$1|1 bait|$1 baiti}})',
'historyempty'        => '(tühi)',

# Revision feed
'history-feed-title'          => 'Redigeerimiste ajalugu',
'history-feed-description'    => 'Selle lehekülje redigeerimiste ajalugu',
'history-feed-item-nocomment' => '$1 - $2', # user at time
'history-feed-empty'          => 'Soovitud lehekülge ei ole olemas.
See võib olla vikist kustutatud või ümber nimetatud.
Ürita [[Special:Search|vikist otsida]] teemakohaseid lehekülgi.',

# Revision deletion
'rev-deleted-comment'         => '(kommentaar eemaldatud)',
'rev-deleted-user'            => '(kasutajanimi eemaldatud)',
'rev-deleted-event'           => '(logitoiming eemaldatud)',
'rev-deleted-text-permission' => '<div class="mw-warning plainlinks">See lehekülje redaktsioon on avalikest arhiividest eemaldatud.
[{{fullurl:Special:Log/delete|page={{FULLPAGENAMEE}}}} Kustutamislogis] võib üksikasju olla.</div>',
'rev-delundel'                => 'näita/peida',
'revisiondelete'              => 'Kustuta/taasta redaktsioone',
'revdelete-selected'          => "'''{{PLURAL:$2|Valitud versioon|Valitud versioonid}} artiklist [[:$1]]:'''",
'logdelete-selected'          => "'''Valitud {{PLURAL:$1|logisissekanne|logisissekanded}}:'''",
'revdelete-legend'            => 'Sea nähtavusele piirangud',
'revdelete-hide-text'         => 'Peida redigeerimise tekst',
'revdelete-hide-name'         => 'Peida toiming ja sihtmärk',
'revdelete-hide-comment'      => 'Peida muudatuse kommentaar',
'revdelete-hide-user'         => 'Peida toimetaja kasutajanimi/IP',
'revdelete-hide-restricted'   => 'Varja andmeid nii ülemate kui ka teiste eest.',
'revdelete-suppress'          => 'Varja andmed nii ülemate kui ka teiste eest.',
'revdelete-hide-image'        => 'Peida faili sisu',
'revdelete-unsuppress'        => 'Eemalda taastatud redaktsioonidelt piirangud',
'revdelete-log'               => 'Logi kommentaar:',
'revdelete-submit'            => 'Pöördu valitud redigeerimise juurde',
'revdelete-logentry'          => 'muutis lehekülje [[$1]] redaktsiooni nähtavust',
'logdelete-logentry'          => 'muutis lehekülje [[$1]] nähtavust',
'revdelete-success'           => "'''Redaktsiooni nähtavus edukalt paigas.'''",
'logdelete-success'           => "'''Logi nähtavus edukalt paigas.'''",
'revdel-restore'              => 'Muuda nähtavust',
'pagehist'                    => 'Lehekülje ajalugu',
'deletedhist'                 => 'Kustutatud ajalugu',
'revdelete-content'           => 'sisu',
'revdelete-summary'           => 'toimeta kokkuvõtet',
'revdelete-uname'             => 'kasutajanimi',
'revdelete-restricted'        => 'kehtestas ülematele piirangud',
'revdelete-unrestricted'      => 'eemaldas ülematelt piirangud',
'revdelete-hid'               => 'peitsin: $1',
'revdelete-unhid'             => 'tegin nähtavaks: $1',

# Suppression log
'suppressionlog'     => 'Varjamislogi',
'suppressionlogtext' => 'Allpool on nimekiri kustutamistest ja blokeeringutes, millega kaasneb ülemate eest sisu varjamine.
Jõus olevad keelud ja blokeeringud leiad [[Special:IPBlockList|blokeeritud IP-aadressie loendist]].',

# History merging
'mergehistory'                     => 'Ühenda lehtede ajalood',
'mergehistory-box'                 => 'Ühenda kahe lehekülje muudatuste ajalugu:',
'mergehistory-from'                => 'Lehekülje allikas:',
'mergehistory-into'                => 'Lehekülje sihtpunkt:',
'mergehistory-list'                => 'Ühendatav redigeerimise ajalugu',
'mergehistory-go'                  => 'Näita ühendatavaid muudatusi',
'mergehistory-submit'              => 'Ühenda redaktsioonid',
'mergehistory-empty'               => 'Ühendatavaid redaktsioone ei ole.',
'mergehistory-success'             => 'Lehekülje [[:$1]] {{PLURAL:$3|üks redaktsioon|$3 redaktsiooni}} liideti lehega [[:$2]].',
'mergehistory-fail'                => 'Muudatuste ajaloo liitmine ebaõnnestus. Palun kontrolli lehekülje ja aja parameetreid.',
'mergehistory-no-source'           => 'Lehekülje allikat $1 ei ole.',
'mergehistory-no-destination'      => 'Lehekülje sihtpunkti $1 ei ole.',
'mergehistory-invalid-source'      => 'Allikaleheküljel peab olema lubatav pealkiri.',
'mergehistory-invalid-destination' => 'Sihtkoha leheküljel peab olema lubatav pealkiri.',
'mergehistory-autocomment'         => 'Liitsin lehe [[:$1]] lehele [[:$2]]',
'mergehistory-comment'             => 'Lehekülg [[:$1]] liidetud leheküljele [[:$2]]: $3',

# Merge log
'mergelog'           => 'Liitmise logi',
'pagemerge-logentry' => 'liitis lehekülje [[$1]] leheküljelega [[$2]] (muudatusi kuni $3)',
'revertmerge'        => 'Tühista ühendamine',
'mergelogpagetext'   => 'Allpool on hiljuti üksteisega liidetud leheküljeajalugude logi.',

# Diffs
'history-title'           => '"$1" muudatuste ajalugu',
'difference'              => '(Erinevused redaktsioonide vahel)',
'lineno'                  => 'Rida $1:',
'compareselectedversions' => 'Võrdle valitud redaktsioone',
'editundo'                => 'eemalda',
'diff-multi'              => '({{PLURAL:$1|Ühte vahepealset muudatust|$1 vahepealset muudatust}} ei näidata.)',

# Search results
'searchresults'             => 'Otsingu tulemused',
'searchresulttext'          => 'Lisainfot otsimise kohta vaata [[{{MediaWiki:Helppage}}|{{int:help}}]].',
'searchsubtitle'            => 'Päring "[[:$1]]"',
'searchsubtitleinvalid'     => 'Päring "$1"',
'noexactmatch'              => "'''Artiklit pealkirjaga \"\$1\" ei leitud.''' Võite [[:\$1|selle artikli luua]].",
'noexactmatch-nocreate'     => "'''Lehekülge pealkirjaga \"\$1\" ei eksisteeri.'''",
'toomanymatches'            => 'Liiga palju tulemusi, ürita teistsugust päringut',
'titlematches'              => 'Vasted artikli pealkirjades',
'notitlematches'            => 'Artikli pealkirjades otsitavat ei leitud',
'textmatches'               => 'Vasted artikli tekstides',
'notextmatches'             => 'Artikli tekstides otsitavat ei leitud',
'prevn'                     => 'eelmised $1',
'nextn'                     => 'järgmised $1',
'viewprevnext'              => 'Näita ($1) ($2) ($3).',
'search-result-size'        => '$1 ({{PLURAL:$2|1 sõna|$2 sõna}})',
'search-result-score'       => 'Vastavus: $1%',
'search-redirect'           => '(ümbersuunamine $1)',
'search-section'            => '(alaosa $1)',
'search-suggest'            => 'Kas Sa mõtlesid: $1',
'search-interwiki-caption'  => 'Sõsarprojektid',
'search-interwiki-default'  => '$1 tulemused:',
'search-interwiki-more'     => '(veel)',
'search-mwsuggest-enabled'  => 'ettepanekutega',
'search-mwsuggest-disabled' => 'ettepanekuid ei ole',
'search-relatedarticle'     => 'Seotud',
'mwsuggest-disable'         => 'Ära näita otsinguvihjeid',
'searchrelated'             => 'seotud',
'searchall'                 => 'kõik',
'showingresults'            => "Allpool näitame {{PLURAL:$1|'''ühte''' tulemit|'''$1''' tulemit}} alates tulemist #'''$2'''.",
'showingresultsnum'         => "Allpool näitame {{PLURAL:$3|'''ühte''' tulemit|'''$3''' tulemit}} alates tulemist #'''$2'''.",
'showingresultstotal'       => "Allpool kuvatakse {{PLURAL:$3|vaste '''$1''' '''$3'''-st|vasted '''$1 - $2''' '''$3'''-st}}",
'nonefound'                 => "'''Märkus''': Otsing hõlmab vaikimisi vaid osasid nimeruume.
Kui soovid otsida ühekorraga kõigist nimeruumidest (kaasa arvatud arutelulehed, mallid, jne) kasuta
päringu ees prefiksit ''all:''. Konkreetsest nimeruumist otsimiseks kasuta prefiksina sele nimeruumi nime.",
'powersearch'               => 'Otsi',
'powersearch-legend'        => 'Detailne otsing',
'powersearch-ns'            => 'Otsing nimeruumidest:',
'powersearch-redir'         => 'Loetle ümbersuunamised',
'powersearch-field'         => 'Otsi fraasi',
'search-external'           => 'Välisotsing',
'searchdisabled'            => "<p>Vabandage! Otsing vikist on ajutiselt peatatud, et säilitada muude teenuste normaalne töökiirus. Otsimiseks võite kasutada allpool olevat Google'i otsinguvormi, kuid sellelt saadavad tulemused võivad olla vananenud.</p>",

# Preferences page
'preferences'              => 'Eelistused',
'mypreferences'            => 'Eelistused',
'prefs-edits'              => 'Redigeerimiste arv:',
'prefsnologin'             => 'Te ei ole sisse loginud',
'prefsnologintext'         => 'Et oma eelistusi seada, peate olema <span class="plainlinks">[{{fullurl:Special:UserLogin|returnto=$1}} sisse logitud]</span>.',
'prefsreset'               => 'Teie eelistused on arvutimälu järgi taastatud.',
'qbsettings'               => 'Kiirriba sätted',
'qbsettings-none'          => 'Ei_ole',
'qbsettings-fixedleft'     => 'Püsivalt_vasakul',
'qbsettings-fixedright'    => 'Püsivalt paremal',
'qbsettings-floatingleft'  => 'Ujuvalt vasakul',
'qbsettings-floatingright' => 'Ujuvalt paremal',
'changepassword'           => 'Muuda parool',
'skin'                     => 'Kujundus',
'math'                     => 'Valemite näitamine',
'dateformat'               => 'Kuupäeva formaat',
'datedefault'              => 'Eelistus puudub',
'datetime'                 => 'Kuupäev ja kellaaeg',
'math_failure'             => 'Arusaamatu süntaks',
'math_unknown_error'       => 'Tundmatu viga',
'math_unknown_function'    => 'Tundmatu funktsioon',
'math_lexing_error'        => 'Väljalugemisviga',
'math_syntax_error'        => 'Süntaksiviga',
'math_image_error'         => "PNG konverteerimine ebaõnnestus;
kontrollige oma ''latex'', ''dvips'', ''gs'', ''convert'' installatsioonide korrektsust.",
'prefs-personal'           => 'Kasutaja andmed',
'prefs-rc'                 => 'Viimased muudatused',
'prefs-watchlist'          => 'Jälgimisloend',
'prefs-watchlist-days'     => 'Mitme päeva muudatusi näidata loendis:',
'prefs-watchlist-edits'    => 'Mitu muudatust näidatakse laiendatud jälgimisloendis:',
'prefs-misc'               => 'Muu',
'saveprefs'                => 'Salvesta eelistused',
'resetprefs'               => 'Lähtesta eelistused',
'oldpassword'              => 'Vana parool',
'newpassword'              => 'Uus parool',
'retypenew'                => 'Sisestage uus parool uuesti',
'textboxsize'              => 'Redigeerimisseaded',
'rows'                     => 'Ridu:',
'columns'                  => 'Veerge:',
'searchresultshead'        => 'Otsingutulemite sätted',
'resultsperpage'           => 'Vasteid leheküljel:',
'contextlines'             => 'Ridu vastes:',
'contextchars'             => 'Kaasteksti rea kohta:',
'stub-threshold'           => '<a href="#" class="stub">Nii</a> lingitud lehekülje suuruse ülempiir (baitides):',
'recentchangesdays'        => 'Mitu päeva näidata viimastes muudatustes:',
'recentchangescount'       => 'Mitut pealkirja näidata vaikimisi viimaste muudatuste lehel, artiklite ajaloolehtedel ja logides:',
'savedprefs'               => 'Teie eelistused on salvestatud.',
'timezonelegend'           => 'Ajavöönd:',
'timezonetext'             => 'Kohaliku aja ja serveri aja (maailmaaja) vahe tundides.',
'localtime'                => 'Kohalik aeg',
'timezoneoffset'           => 'Ajavahe',
'servertime'               => 'Serveri aeg',
'guesstimezone'            => 'Loe aeg brauserist',
'allowemail'               => 'Luba teistel kasutajatel mulle e-posti saata',
'prefs-searchoptions'      => 'Otsimine',
'prefs-namespaces'         => 'Nimeruumid',
'defaultns'                => 'Vaikimisi otsi järgmistest nimeruumidest:',
'default'                  => 'vaikeväärtus',
'files'                    => 'Failid',

# User rights
'userrights'                  => 'Kasutaja õiguste muutmine', # Not used as normal message but as header for the special page itself
'userrights-lookup-user'      => 'Muuda kasutajarühma',
'userrights-user-editname'    => 'Sisesta kasutajatunnus:',
'editusergroup'               => 'Muuda kasutajarühma',
'editinguser'                 => "Redigeerimisel on '''[[User:$1|$1]]''' ([[User talk:$1|{{int:talkpagelinktext}}]] | [[Special:Contributions/$1|{{int:contribslink}}]])",
'userrights-editusergroup'    => 'Kasutajarühma valik',
'saveusergroups'              => 'Salvesta rühma muudatused',
'userrights-groupsmember'     => 'Kuulub rühma:',
'userrights-groups-help'      => 'Sa võid muuta selle kasutaja kuuluvust eri kasutajarühmadesse.
* Märgitud kast tähendab, et kasutaja kuulub sellesse rühma.
* Märkimata kast tähendab, et kasutaja ei kuulu sellesse rühma.
* Aga * kasutajarühma juures tähistab õigust, mida sa peale lisamist enam eemaldada ei saa, või siis ka vastupidi.',
'userrights-reason'           => 'Muutmise põhjus:',
'userrights-no-interwiki'     => 'Sul ei ole luba muuta kasutajaõigusi teistes vikides.',
'userrights-nodatabase'       => 'Andmebaasi $1 ei ole olemas või pole see kohalik.',
'userrights-nologin'          => 'Kasutaja õiguste muutmiseks, pead sa ülema õigustega kontoga [[Special:UserLogin|sisse logima]].',
'userrights-notallowed'       => 'Sulle pole antud luba jagada kasutajatele õigusi.',
'userrights-changeable-col'   => 'Rühmad, mida sa saad muuta',
'userrights-unchangeable-col' => 'Rühmad, mida sa ei saa muuta',

# Groups
'group'               => 'Rühm:',
'group-user'          => 'Kasutajad',
'group-autoconfirmed' => 'Automaatselt kinnitatud kasutajad',
'group-bot'           => 'Robotid',
'group-sysop'         => 'Ülemad',
'group-bureaucrat'    => 'Bürokraadid',
'group-suppress'      => 'Varjajad',
'group-all'           => '(kõik)',

'group-user-member'          => 'Kasutaja',
'group-autoconfirmed-member' => 'Automaatselt kinnitatud kasutaja',
'group-bot-member'           => 'Robot',
'group-sysop-member'         => 'Ülem',
'group-bureaucrat-member'    => 'Bürokraat',
'group-suppress-member'      => 'Varjaja',

'grouppage-user'          => '{{ns:project}}:Kasutajad',
'grouppage-autoconfirmed' => '{{ns:project}}:Automaatselt kinnitatud kasutajad',
'grouppage-bot'           => '{{ns:project}}:Robotid',
'grouppage-sysop'         => '{{ns:project}}:Administraatorid',
'grouppage-bureaucrat'    => '{{ns:project}}:Bürokraadid',
'grouppage-suppress'      => '{{ns:project}}:Varjaja',

# Rights
'right-read'                 => 'Lugeda lehekülgi',
'right-edit'                 => 'Redigeerida lehekülje sisu',
'right-createpage'           => 'Luua lehekülgi (mis pole arutelu leheküljed)',
'right-createtalk'           => 'Luua arutelu lehekülgi',
'right-createaccount'        => 'Luua uusi kasutajakontosid',
'right-minoredit'            => 'Märkida muudatusi pisimuudatustena',
'right-move'                 => 'Teisaldada lehekülgi',
'right-move-subpages'        => 'Teisaldada lehekülgi koos nende alamlehtedega',
'right-suppressredirect'     => 'Teisaldada lehekülgi ümbersuunamist loomata',
'right-upload'               => 'Faile üles laadida',
'right-reupload'             => 'Kirjutada olemasolevaid faile üle',
'right-reupload-own'         => 'Üle kirjutada enda üles laaditud faile',
'right-reupload-shared'      => 'Asendada kohalikus vikis jagatud failivaramu faile',
'right-upload_by_url'        => 'Faile internetiaadressilt üles laadida',
'right-purge'                => 'Tühjendada lehekülje vahemälu kinnituseta',
'right-autoconfirmed'        => 'Redigeerida poolkaitstud lehekülgi',
'right-bot'                  => 'Olla koheldud kui automaadistatud toimimisviis',
'right-nominornewtalk'       => 'Teha arutelulehekülgedel pisimuudatusi, ilma et lehekülg märgitaks uuena',
'right-apihighlimits'        => 'Kasutada API-päringutes kõrgemaid limiite',
'right-writeapi'             => 'Kasutada {{SITENAME}} kirjutamise liidest',
'right-delete'               => 'Lehekülgi kustutada',
'right-bigdelete'            => 'Pikkade ajalugudega lehekülgi kustutada',
'right-deleterevision'       => 'Kustutada ja taastada lehekülgede teatud redaktsioone',
'right-deletedhistory'       => 'Vaadata kustutatud ajalookirjeid ilma seotud tekstita',
'right-browsearchive'        => 'Otsida kustutatud lehekülgi',
'right-undelete'             => 'Taastada lehekülg',
'right-suppressrevision'     => 'Üle vaadata ja taastada ülemate eest peidetud redaktsioone',
'right-suppressionlog'       => 'Vaadata eralogisid',
'right-block'                => 'Keelata lehekülgede muutmist mõnel kasutajal',
'right-blockemail'           => 'Keelata kasutajal e-kirjade saatmine',
'right-hideuser'             => 'Blokeerida kasutajanimi, peites selle avalikkuse eest',
'right-ipblock-exempt'       => 'Mööduda automaatsetest blokeeringutest ning aadressivahemiku- ja IP-blokeeringutest',
'right-proxyunbannable'      => 'Mööduda automaatsetest puhverserveri blokeeringutest',
'right-protect'              => 'Muuta kaitsetasemeid ja redigeerida kaitstud lehekülgi',
'right-editprotected'        => 'Muuta kaitstud lehekülgi, millel ei ole kaskaadkaitset',
'right-editinterface'        => 'Muuta kasutajaliidest',
'right-editusercssjs'        => 'Redigeerida teiste kasutajate CSS ja JS faile',
'right-rollback'             => 'Tühistada otsekohe muudatused, mille tegi kasutaja, kes lehekülge viimati redigeeris.',
'right-markbotedits'         => 'Märkida muudatuse tühistamine robotimuudatusena',
'right-noratelimit'          => 'Mööduda toimingumäära limiitidest',
'right-import'               => 'Importida lehekülgi teistest vikidest',
'right-importupload'         => 'Importida XML-dokumendi lehekülgi',
'right-patrol'               => 'Märkida teiste redigeerimised kontrollituks',
'right-autopatrol'           => 'Teha vaikimisi kontrollituks märgitud muudatusi',
'right-patrolmarks'          => 'Vaadata viimaste muudatuste kontrollimise märkeid',
'right-unwatchedpages'       => 'Vaadata jälgimata lehekülgede nimekirja',
'right-trackback'            => "Lähetada ''trackback''",
'right-mergehistory'         => 'Ühendada lehekülgede ajalood',
'right-userrights'           => 'Muuta kõiki kasutajaõigusi',
'right-userrights-interwiki' => 'Muuta teiste vikide kasutajate õigusi',
'right-siteadmin'            => 'Panna lukku ja lukust lahti teha andmebaasi',

# User rights log
'rightslog'      => 'Kasutaja õiguste logi',
'rightslogtext'  => 'See on logi kasutajate õiguste muutuste kohta.',
'rightslogentry' => 'muutis kasutaja $1 rühmast $2 rühma $3 liikmeks',
'rightsnone'     => '(puudub)',

# Recent changes
'nchanges'                          => '$1 {{PLURAL:$1|muudatus|muudatust}}',
'recentchanges'                     => 'Viimased muudatused',
'recentchangestext'                 => 'Jälgige sellel leheküljel viimaseid muudatusi.',
'recentchanges-feed-description'    => 'Jälgi vikisse tehtud viimaseid muudatusi.',
'rcnote'                            => "Allpool on esitatud {{PLURAL:$1|'''1''' muudatus|viimased '''$1''' muudatust}} viimase {{PLURAL:$2|päeva|'''$2''' päeva}} jooksul, seisuga $4, kell $5.",
'rcnotefrom'                        => 'Allpool on esitatud muudatused alates <b>$2</b> (näidatakse kuni <b>$1</b> muudatust).',
'rclistfrom'                        => 'Näita muudatusi alates $1',
'rcshowhideminor'                   => '$1 pisiparandused',
'rcshowhidebots'                    => '$1 robotid',
'rcshowhideliu'                     => '$1 sisseloginud kasutajad',
'rcshowhideanons'                   => '$1 anonüümsed kasutajad',
'rcshowhidepatr'                    => '$1 kontrollitud muudatused',
'rcshowhidemine'                    => '$1 minu parandused',
'rclinks'                           => 'Näita viimast $1 muudatust viimase $2 päeva jooksul<br />$3',
'diff'                              => 'erin',
'hist'                              => 'ajal',
'hide'                              => 'peida',
'show'                              => 'näita',
'minoreditletter'                   => 'P',
'newpageletter'                     => 'U',
'boteditletter'                     => 'b',
'number_of_watching_users_pageview' => '[$1 {{PLURAL:$1|jälgiv kasutaja|jälgivat kasutajat}}]',
'rc_categories'                     => 'Ainult kategooriatest (eraldajaks "|")',
'rc_categories_any'                 => 'Mistahes',
'newsectionsummary'                 => '/* $1 */ uus alajaotus',

# Recent changes linked
'recentchangeslinked'          => 'Seotud muudatused',
'recentchangeslinked-title'    => 'Leheküljega "$1" seotud muudatused',
'recentchangeslinked-noresult' => 'Antud ajavahemiku jooksul ei ole lingitud lehekülgedel muudatusi tehtud.',
'recentchangeslinked-summary'  => "See on viimaste muudatuste nimekiri lehekülgedel, kuhu lähevad lingid antud leheküljelt (või antud kategooria liikmetele).
Leheküljed, mis lähevad [[Special:Watchlist|Jälgimisloendi]] koosseisu, on esiletoodud '''rasvasena'''.",
'recentchangeslinked-page'     => 'Lehekülje nimi:',
'recentchangeslinked-to'       => 'Näita hoopis muudatusi lehekülgedel, mis sellele lehele lingivad',

# Upload
'upload'                      => 'Faili üleslaadimine',
'uploadbtn'                   => 'Laadi fail üles',
'reupload'                    => 'Uuesti üleslaadimine',
'reuploaddesc'                => 'Tagasi üleslaadimise vormi juurde.',
'uploadnologin'               => 'Sisse logimata',
'uploadnologintext'           => 'Kui Te soovite faile üles laadida, peate [[Special:UserLogin|sisse logima]].',
'upload_directory_missing'    => 'Üleslaadimiskaust $1 puudub ja veebiserver ei saa seda luua.',
'upload_directory_read_only'  => 'Veebiserveril ei õnnestu üleslaadimiste kataloogi ($1) kirjutada.',
'uploaderror'                 => 'Faili laadimine ebaõnnestus',
'uploadtext'                  => '<strong>STOPP!</strong> Enne kui sooritad üleslaadimise,
peaksid tagama, et see järgib siinset [[{{MediaWiki:Policy-url}}|piltide kasutamise korda]].

Et näha või leida eelnevalt üleslaetud pilte,
mine vaata [[Special:ImageList|piltide nimekirja]].
Üleslaadimised ning kustutamised logitakse [[Special:Log/upload|üleslaadimise logis]].

Järgneva vormi abil saad laadida üles uusi pilte
oma artiklite illustreerimiseks.
Enamikul brauseritest, näed nuppu "Browse...", mis viib sind
sinu operatsioonisüsteemi standardsesse failiavamisaknasse.
Faili valimisel sisestatakse selle faili nimi tekstiväljale
nupu kõrval.
Samuti pead märgistama kastikese, kinnitades sellega,
et sa ei riku seda faili üleslaadides kellegi autoriõigusi.
Üleslaadimise lõpuleviimiseks vajuta nupule "Üleslaadimine".
See võib võtta pisut aega, eriti kui teil on aeglane internetiühendus.

Eelistatud formaatideks on fotode puhul JPEG , joonistuste
ja ikoonilaadsete piltide puhul PNG, helide jaoks aga OGG.
Nimeta oma failid palun nõnda, et nad kirjeldaksid arusaadaval moel faili sisu, see aitab segadusi vältida.
Pildi lisamiseks artiklile, kasuta linki kujul:
<b><nowiki>[[</nowiki>{{ns:image}}<nowiki>:pilt.jpg]]</nowiki></b> või <b><nowiki>[[</nowiki>{{ns:image}}<nowiki>:pilt.png|alt. tekst]]</nowiki></b>.
Helifaili puhul: <b><nowiki>[[</nowiki>{{ns:media}}<nowiki>:fail.ogg]]</nowiki></b>.

Pane tähele, et nagu ka ülejäänud siinsete lehekülgede puhul,
võivad teised sinu poolt laetud faile saidi huvides
muuta või kustutada ning juhul kui sa süsteemi kuritarvitad
võidakse sinu ligipääs sulgeda.',
'upload-permitted'            => 'Lubatud failitüübid: $1.',
'upload-preferred'            => 'Eelistatud failitüübid: $1.',
'upload-prohibited'           => 'Keelatud failitüübid: $1.',
'uploadlog'                   => 'üleslaadimise logi',
'uploadlogpage'               => 'Üleslaadimise logi',
'uploadlogpagetext'           => 'Allpool on loend viimastest failide üleslaadimistest. Kõik ajad näidatakse serveri aja järgi.',
'filename'                    => 'Faili nimi',
'filedesc'                    => 'Lühikirjeldus',
'fileuploadsummary'           => 'Info faili kohta:',
'filestatus'                  => 'Autoriõiguse staatus:',
'filesource'                  => 'Allikas:',
'uploadedfiles'               => 'Üleslaaditud failid',
'ignorewarning'               => 'Ignoreeri hoiatust ja salvesta fail hoiatusest hoolimata',
'ignorewarnings'              => 'Ignoreeri hoiatusi',
'minlength1'                  => 'Faili nimes peab olema vähemalt üks kirjamärk.',
'illegalfilename'             => 'Faili "$1" nimi sisaldab sümboleid, mis pole pealkirjades lubatud. Palun nimetage fail ümber ja proovige uuesti.',
'badfilename'                 => 'Pildi nimi on muudetud. Uus nimi on "$1".',
'filetype-badmime'            => 'MIME tüübiga "$1" faile ei ole lubatud üles laadida.',
'filetype-bad-ie-mime'        => 'Seda faili ei saa üles laadida, sest Internet Explorer avastaks, et selle MIME tüüp on "$1", mis on keelatud või võimalik ohtlik failitüüp.',
'filetype-unwanted-type'      => "'''\".\$1\"''' on soovimatu failitüüp.
Eelistatud {{PLURAL:\$3|failitüüp on|failitüübid on}} \$2.",
'filetype-banned-type'        => "'''\".\$1\"''' ei ole lubatud failitüüp.  Lubatud {{PLURAL:\$3|failitüüp|failitüübid}} on  \$2.",
'filetype-missing'            => 'Failil puudub laiend (nagu näiteks ".jpg").',
'large-file'                  => 'On soovitatav, et üleslaaditavad failid ei oleks suuremad kui $1. Selle faili suurus on $2.',
'largefileserver'             => 'Antud fail on suurem lubatud failisuurusest.',
'emptyfile'                   => 'Fail, mille Te üles laadisite, paistab olevat tühi.
See võib olla tingitud vigasest failinimest.
Palun kaalutlege, kas Te tõesti soovite seda faili üles laadida.',
'fileexists'                  => "Sellise nimega fail on juba olemas. Palun kontrollige '''<tt>$1</tt>''', kui te ei ole kindel, kas tahate seda muuta.",
'filepageexists'              => "Selle faili kirjelduslehekülg '''<tt>$1</tt>''' on juba loodud, aga selle nimega faili hetkel pole.
Sinu sisestatud kokkuvõtet ei kuvata kirjeldusleheküljel.
Sinu kokkuvõtte kuvamiseks tuleb kirjelduslehekülge eraldi redigeerida.",
'fileexists-extension'        => "Sarnase nimega fail on olemas:<br />
Üleslaetava faili nimi: '''<tt>$1</tt>'''<br />
Olemasoleva faili nimi: '''<tt>$2</tt>'''<br />
Palun vali teistsugune nimi.",
'fileexists-thumb'            => "<center>'''Fail on olemas'''</center>",
'fileexists-thumbnail-yes'    => "See paistab olevat vähendatud suurusega pilt (''pisipilt'').
Palun vaata faili '''<tt>$1</tt>'''.<br />
Kui vaadatud fail on sama pilt algupärases suuruses, pole vaja täiendavat pisipilti üles laadida.",
'file-thumbnail-no'           => "Failinimi algab eesliitega '''<tt>$1</tt>'''.
See paistab vähendatud suurusega pilt (''pisipilt'') olevat.
Kui sul on ka selle pildi täislahutusega versioon, laadi palun hoopis see üles, vastasel korral muuda palun faili nime.",
'fileexists-forbidden'        => 'Sellise nimega fail on juba olemas, palun pöörduge tagasi ja laadige fail üles mõne teise nime all. [[Image:$1|thumb|center|$1]]',
'fileexists-shared-forbidden' => 'Samanimeline fail on juba olemas jagatud failivaramus.
Kui soovid siiski oma faili üles laadida, mine palun tagasi ja kasuta teist failinime.
[[Image:$1|thumb|center|$1]]',
'file-exists-duplicate'       => 'See fail on {{PLURAL:$1|järgneva faili|järgnevate failide}} duplikaat:',
'successfulupload'            => 'Üleslaadimine õnnestus',
'uploadwarning'               => 'Üleslaadimise hoiatus',
'savefile'                    => 'Salvesta fail',
'uploadedimage'               => 'laadis üles faili "[[$1]]"',
'overwroteimage'              => 'laadis üles faili "[[$1]]" uue versiooni',
'uploaddisabled'              => 'Üleslaadimine hetkel keelatud',
'uploaddisabledtext'          => 'Faili üleslaadimine on keelatud.',
'uploadscripted'              => 'See fail sisaldab HTML- või skriptikoodi, mida veebilehitseja võib valesti kuvada.',
'uploadcorrupt'               => 'Fail on vigane või vale laiendiga. Palun kontrolli faili ja proovi seda uuesti üles laadida.',
'uploadvirus'                 => 'Fail sisaldab viirust! Täpsemalt: $1',
'sourcefilename'              => 'Lähtefail:',
'destfilename'                => 'Failinimi vikis:',
'upload-maxfilesize'          => 'Maksimaalne failisuurus: $1',
'watchthisupload'             => 'Jälgi seda lehekülge',
'filewasdeleted'              => 'Selle nimega fail on lisatud ja kustutatud hiljuti.
Kontrolli $1 enne jätkamist.',
'upload-wasdeleted'           => "'''Hoiatus: Sa laadid üles faili, mis on eelnevalt kustutatud.'''

Peaksid kaaluma, kas selle faili üleslaadimise jätkamine on sobilik.
Selle faili kustutamislogi on toodud siinsamas:",
'filename-bad-prefix'         => "Üleslaaditava faili nimi algab eesliitega '''\"\$1\"''', mis on omane digikaamera antud ebamäärastele nimedele.
Palun vali oma failile kirjeldavam nimi.",

'upload-proto-error'     => 'Vigane protokoll',
'upload-file-error'      => 'Sisemine viga',
'upload-file-error-text' => 'Sisemine viga ilmnes, kui üritati luua ajutist faili serveris. 
Palun kontakteeru [[Special:ListUsers/sysop|administraatoriga]].',
'upload-misc-error'      => 'Tundmatu viga üleslaadimisel',
'upload-misc-error-text' => 'Üleslaadimisel ilmnes tundmatu tõrge.
Palun veendu, et internetiaadress on õige ja ligipääsetav ning proovi uuesti.
Kui probleem ei kao, võta ühendust [[Special:ListUsers/sysop|ülemaga]].',

# Some likely curl errors. More could be added from <http://curl.haxx.se/libcurl/c/libcurl-errors.html>
'upload-curl-error6'       => 'Internetiaadress pole kättesaadav',
'upload-curl-error6-text'  => 'Etteantud internetiaadress ei ole kättesaadav.
Palun kontrolli, kas aadress on õige ja kas võrgukoht on üleval.',
'upload-curl-error28'      => 'Üleslaadimise ajalimiit',
'upload-curl-error28-text' => 'Võrgukohal läks vastamiseks liiga kaua.
Palun kontrolli kas võrgukoht on ikka üleval, oota natuke ja proovi uuesti.
Samuti võid proovida siis, kui võrgukoht on vähem hõivatud.',

'license'            => 'Litsents:',
'nolicense'          => 'pole valitud',
'license-nopreview'  => '(Eelvaade ei ole saadaval)',
'upload_source_url'  => '(avalikult ligipääsetav URL)',
'upload_source_file' => '(fail sinu arvutis)',

# Special:ImageList
'imagelist-summary'     => 'See erilehekülg kuvab kõik üleslaaditud failid.
Vaikimisi on kõige ees viimati üleslaaditud failid.
Tulba päisel klõpsamine muudab sortimist.',
'imagelist_search_for'  => 'Otsi faili:',
'imgfile'               => 'fail',
'imagelist'             => 'Piltide loend',
'imagelist_date'        => 'Kuupäev',
'imagelist_name'        => 'Nimi',
'imagelist_user'        => 'Kasutaja',
'imagelist_size'        => 'Suurus',
'imagelist_description' => 'Kirjeldus',

# Image description page
'filehist'                       => 'Faili ajalugu',
'filehist-help'                  => 'Klõpsa kuupäeva ja kellaaega, et näha sel ajahetkel kasutusel olnud failiversiooni.',
'filehist-deleteall'             => 'kustuta kõik',
'filehist-deleteone'             => 'kustuta see',
'filehist-revert'                => 'taasta',
'filehist-current'               => 'viimane',
'filehist-datetime'              => 'Kuupäev/kellaaeg',
'filehist-user'                  => 'Kasutaja',
'filehist-dimensions'            => 'Mõõtmed',
'filehist-filesize'              => 'Faili suurus',
'filehist-comment'               => 'Kommentaar',
'imagelinks'                     => 'Viited failile',
'linkstoimage'                   => 'Sellele pildile {{PLURAL:$1|viitab järgmine lehekülg|viitavad järgmised leheküljed}}:',
'nolinkstoimage'                 => 'Sellele pildile ei viita ükski lehekülg.',
'morelinkstoimage'               => 'Vaata [[Special:WhatLinksHere/$1|veel linke]], mis sellele failile viitavad.',
'redirectstofile'                => 'Selle faili juurde {{PLURAL:$1|suunab järgnev fail|suunavad järgnevad $1 faili}}:',
'duplicatesoffile'               => '{{PLURAL:$1|Järgnev fail|Järgnevad $1 faili}} on selle faili {{PLURAL:$1|duplikaat|duplikaadid}}:',
'sharedupload'                   => 'See fail on ühiskasutuses ja seda võib kasutada teistes projektides.',
'shareduploadwiki-desc'          => 'Sealne $1 on toodud allpool.',
'shareduploadwiki-linktext'      => 'faili kirjelduse lehekülg',
'shareduploadduplicate-linktext' => 'teine fail',
'noimage'                        => 'Sellise nimega faili pole, võite selle $1.',
'noimage-linktext'               => 'üles laadida',
'uploadnewversion-linktext'      => 'Laadi üles selle faili uus versioon',
'imagepage-searchdupe'           => 'Otsi faili duplikaate',

# File reversion
'filerevert'                => 'Taasta $1',
'filerevert-legend'         => 'Faili taastamine',
'filerevert-intro'          => "Sa taastad faili '''[[Media:$1|$1]]''' seisuga [$4 $3, $2 kasutusel olnud versiooni].",
'filerevert-comment'        => 'Põhjus:',
'filerevert-defaultcomment' => 'Naaseti redaktsiooni juurde, mis loodi $1 kell $2',
'filerevert-submit'         => 'Taasta',
'filerevert-success'        => "Faili '''[[Media:$1|$1]]''' seisuga [$4 $3, $2 kasutusel olnud versioon] on taastatud.",
'filerevert-badversion'     => 'Failist ei ole kohalikku versiooni tagatud ajamarkeeringuga.',

# File deletion
'filedelete'                  => 'Kustuta $1',
'filedelete-legend'           => 'Kustuta fail',
'filedelete-intro'            => "Oled kustutamas faili '''[[Media:$1|$1]]''' ja kogu selle ajalugu.",
'filedelete-intro-old'        => "Sa kustutad faili '''[[Media:$1|$1]]''' seisuga [$4 $3, $2] kasutusel olnud versiooni.",
'filedelete-comment'          => 'Kustutamise põhjus:',
'filedelete-submit'           => 'Kustuta',
'filedelete-success'          => "'''$1''' on kustutatud.",
'filedelete-success-old'      => "Faili '''[[Media:$1|$1]]''' seisuga $3, $2 kasutusel olnud versioon on kustutatud.",
'filedelete-nofile'           => "Faili '''$1''' ei ole.",
'filedelete-otherreason'      => 'Muu/täiendav põhjus',
'filedelete-reason-otherlist' => 'Muu põhjus',
'filedelete-reason-dropdown'  => '*Harilikud kustutamise põhjused
** Autoriõiguste rikkumine
** Duplikaat',
'filedelete-edit-reasonlist'  => 'Redigeeri kustutamise põhjuseid',

# MIME search
'mimesearch'         => 'MIME otsing',
'mimesearch-summary' => 'Selle leheküljega saab faile otsida MIME tüübi järgi.
Sisesta kujul tüüp/alamtüüp, näiteks <tt>image/jpeg</tt>.',
'mimetype'           => 'MIME tüüp:',
'download'           => 'laadi alla',

# Unwatched pages
'unwatchedpages' => 'Jälgimata lehed',

# List redirects
'listredirects' => 'Ümbersuunamised',

# Unused templates
'unusedtemplates'     => 'Kasutamata mallid',
'unusedtemplatestext' => 'See lehekülg loetleb kõik leheküljed nimeruumis {{ns:template}}, mida teistel lehekülgedel ei kasutata. Enne kustutamist palun kontrollige, kas siia pole muid linke.',
'unusedtemplateswlh'  => 'teised lingid',

# Random page
'randompage'         => 'Juhuslik artikkel',
'randompage-nopages' => 'Selles nimeruumis ei ole lehekülgi.',

# Random redirect
'randomredirect' => 'Juhuslik ümbersuunamine',

# Statistics
'statistics'             => 'Arvandmestik',
'sitestats'              => 'Saidi statistika',
'userstats'              => 'Kasutaja statistika',
'sitestatstext'          => "Andmebaas sisaldab kokku {{PLURAL:$1|'''1''' lehekülje|'''$1''' lehekülge}}.
See arv hõlmab ka arutelulehekülgi, abilehekülgi, väga lühikesi lehekülgi (nuppe), ümbersuunamislehekülgi ning muid lehekülgi. Ilma neid arvestamata on vikis praegu {{PLURAL:$2|'''1''' lehekülg|'''$2''' lehekülge}}, mida võib pidada artikliteks.

Üles on laetud '''$8''' {{PLURAL:$8|fail|faili}}.

Alates {{SITENAME}} töösse seadmisest on lehekülgede vaatamisi kokku '''$3''' ja redigeerimisi '''$4'''.
Seega keskmiselt '''$5''' redigeerimist lehekülje kohta ja '''$6''' lehekülje vaatamist ühe redigeerimise kohta.

[http://www.mediawiki.org/wiki/Manual:Job_queue Töö järjekorra] pikkus on '''$7'''.",
'userstatstext'          => "Registreeritud [[Special:ListUsers|kasutajate]] arv: '''$1''', kelledest '''$2''' (ehk '''$4%''') on $5 õigused.",
'statistics-mostpopular' => 'Enim vaadatud leheküljed',

'disambiguations'      => 'Täpsustusleheküljed',
'disambiguationspage'  => 'Template:Täpsustuslehekülg',
'disambiguations-text' => "Loetletud leheküljed viitavad '''täpsustusleheküljele'''.
Selle asemel peaks nad olema lingitud sobivasse artiklisse.
Lehekülg loetakse täpsustusleheküljeks, kui see kasutab malli, millele viitab sõnum [[MediaWiki:Disambiguationspage]].",

'doubleredirects'            => 'Kahekordsed ümbersuunamised',
'doubleredirectstext'        => 'Käesolev leht esitab loendi lehtedest, mis sisaldavad ümbersuunamisi teistele ümbersuunamislehtedele.
Igal real on ära toodud esimene ja teine ümbersuunamisleht ning samuti teise ümbersuunamislehe sihtmärk, mis tavaliselt on esialgse ümbersuunamise tegelik siht, millele see otse osutama peakski.
<s>Läbikriipsutatud</s> kirjed on kohendatud.',
'double-redirect-fixed-move' => '[[$1]] on teisaldatud, see suunab nüüd leheküljele [[$2]].',
'double-redirect-fixer'      => 'Ümbersuunamiste parandaja',

'brokenredirects'        => 'Vigased ümbersuunamised',
'brokenredirectstext'    => 'Järgmised leheküljed on ümber suunatud olematutele lehekülgedele:',
'brokenredirects-edit'   => '(redigeeri)',
'brokenredirects-delete' => '(kustuta)',

'withoutinterwiki'         => 'Keelelinkideta leheküljed',
'withoutinterwiki-summary' => 'Loetletud leheküljed ei viita erikeelsetele versioonidele.',
'withoutinterwiki-legend'  => 'Eesliide',
'withoutinterwiki-submit'  => 'Näita',

'fewestrevisions' => 'Leheküljed, kus on kõige vähem muudatusi tehtud',

# Miscellaneous special pages
'nbytes'                  => '$1 {{PLURAL:$1|bait|baiti}}',
'ncategories'             => '$1 {{PLURAL:$1|kategooria|kategooriat}}',
'nlinks'                  => '$1 {{PLURAL:$1|link|linki}}',
'nmembers'                => '$1 {{PLURAL:$1|liige|liiget}}',
'nrevisions'              => '$1 {{PLURAL:$1|redaktsioon|redaktsiooni}}',
'nviews'                  => '$1 {{PLURAL:$1|külastus|külastust}}',
'specialpage-empty'       => 'Vasteid ei leidu.',
'lonelypages'             => 'Viitamata artiklid',
'lonelypagestext'         => 'Järgmistele lehekülgedele ei ole linki ühelgi Viki leheküljel, samuti ei ole nad kasutusel teiste lehekülgede osana.',
'uncategorizedpages'      => 'Kategoriseerimata leheküljed',
'uncategorizedcategories' => 'Kategoriseerimata kategooriad',
'uncategorizedimages'     => 'Kategoriseerimata failid',
'uncategorizedtemplates'  => 'Kategoriseerimata mallid',
'unusedcategories'        => 'Kasutamata kategooriad',
'unusedimages'            => 'Kasutamata pildid',
'popularpages'            => 'Loetumad artiklid',
'wantedcategories'        => 'Kõige oodatumad kategooriad',
'wantedpages'             => 'Kõige oodatumad artiklid',
'missingfiles'            => 'Puuduvad failid',
'mostlinked'              => 'Kõige viidatumad leheküljed',
'mostlinkedcategories'    => 'Kõige viidatumad kategooriad',
'mostlinkedtemplates'     => 'Kõige viidatumad mallid',
'mostcategories'          => 'Enim kategoriseeritud artiklid',
'mostimages'              => 'Kõige kasutatumad failid',
'mostrevisions'           => 'Kõige pikema redigeerimislooga artiklid',
'prefixindex'             => 'Kõik pealkirjad eesliitega',
'shortpages'              => 'Lühikesed artiklid',
'longpages'               => 'Pikad artiklid',
'deadendpages'            => 'Edasipääsuta artiklid',
'deadendpagestext'        => 'Järgmised leheküljed ei viita ühelegi teisele Viki leheküljele.',
'protectedpages'          => 'Kaitstud leheküljed',
'protectedpages-indef'    => 'Ainult määramata ajani kaitstud',
'protectedpagestext'      => 'Järgnevad leheküljed on teisaldamise või redigeerimise eest kaitstud',
'protectedpagesempty'     => 'Selliste parameetritega ei ole praegu ühtegi lehekülge kaitstud.',
'protectedtitles'         => 'Kaitstud pealkirjad',
'protectedtitlestext'     => 'Järgnevad pealkirjad on lehekülje loomise eest kaitstud',
'protectedtitlesempty'    => 'Hetkel pole ükski pealkiri kaitstud.',
'listusers'               => 'Kasutajad',
'newpages'                => 'Uued leheküljed',
'newpages-username'       => 'Kasutajanimi:',
'ancientpages'            => 'Kõige vanemad artiklid',
'move'                    => 'Teisalda',
'movethispage'            => 'Muuda pealkirja',
'unusedimagestext'        => 'Pange palun tähele, et teised veebisaidid võivad linkida failile otselingiga ja seega võivad siin toodud failid olla ikkagi aktiivses kasutuses.',
'unusedcategoriestext'    => 'Need kategooriad pole ühesgi artiklis või teises kategoorias kasutuses.',
'notargettitle'           => 'Puudub sihtlehekülg',
'notargettext'            => 'Sa ei ole esitanud sihtlehekülge ega kasutajat, kelle kallal seda operatsiooni toime panna.',
'nopagetitle'             => 'Sihtpunktiks määratud lehekülge ei ole',
'nopagetext'              => 'Lehekülg, mille sa sihtpunktiks määrasid, ei eksisteeri.',
'pager-newer-n'           => '{{PLURAL:$1|uuem 1|uuemad $1}}',
'pager-older-n'           => '{{PLURAL:$1|vanem 1|vanemad $1}}',
'suppress'                => 'Varjamine',

# Book sources
'booksources'               => 'Otsi raamatut',
'booksources-search-legend' => 'Otsi raamatut',
'booksources-go'            => 'Mine',
'booksources-text'          => 'Allpool on linke teistele lehekülgedele, kus müüakse uusi ja kasutatud raamatuid. Lehekülgedel võib olla ka lisainfot raamatute kohta:',

# Special:Log
'specialloguserlabel'  => 'Kasutaja:',
'speciallogtitlelabel' => 'Pealkiri:',
'log'                  => 'Logid',
'all-logs-page'        => 'Kõik avalikud logid',
'log-search-legend'    => 'Otsi logisid',
'log-search-submit'    => 'Mine',
'alllogstext'          => 'See on võrgukoha {{SITENAME}} kõigi olemasolevate logide ühendkuva.
Valiku kitsendamiseks vali logitüüp, sisesta kasutajanimi (tõstutundlik) või huvipakkuva lehekülje pealkiri (samuti tõstutundlik).',
'logempty'             => 'Logis puuduvad vastavad kirjed.',
'log-title-wildcard'   => 'Selle tekstiga algavad pealkirjad',

# Special:AllPages
'allpages'          => 'Kõik leheküljed',
'alphaindexline'    => '$1 kuni $2',
'nextpage'          => 'Järgmine lehekülg ($1)',
'prevpage'          => 'Eelmine lehekülg ($1)',
'allpagesfrom'      => 'Näita lehti alates pealkirjast:',
'allarticles'       => 'Kõik artiklid',
'allinnamespace'    => 'Kõik artiklid ($1 nimeruum)',
'allnotinnamespace' => 'Kõik artiklid (mis ei kuulu $1 nimeruumi)',
'allpagesprev'      => 'Eelmised',
'allpagesnext'      => 'Järgmised',
'allpagessubmit'    => 'Näita',
'allpagesprefix'    => 'Kuva leheküljed eesliitega:',
'allpagesbadtitle'  => 'Lehekülje pealkiri oli vigane või sisaldas teise viki või keele eesliidet.
See võib sisaldada üht või enamat märki, mida ei saa pealkirjades kasutada.',

# Special:Categories
'categories'                    => 'Kategooriad',
'categoriespagetext'            => 'Vikis on järgmised kategooriad.
Siin ei näidata [[Special:UnusedCategories|Unused categories]].
Vaata ka [[Special:WantedCategories|wanted categories]].',
'categoriesfrom'                => 'Näita kategooriaid alates:',
'special-categories-sort-count' => 'sorteeri hulga järgi',
'special-categories-sort-abc'   => 'sorteeri tähestikuliselt',

# Special:ListUsers
'listusersfrom'      => 'Näita kasutajaid alustades:',
'listusers-submit'   => 'Näita',
'listusers-noresult' => 'Kasutajat ei leitud.',

# Special:ListGroupRights
'listgrouprights'               => 'Kasutajarühma õigused',
'listgrouprights-summary'       => 'Siin on loetletud selle viki kasutajarühmad ja rühmaga seotud õigused.
Üksikute õiguste kohta võib olla [[{{MediaWiki:Listgrouprights-helppage}}|täiendavat teavet]].',
'listgrouprights-group'         => 'Rühm',
'listgrouprights-rights'        => 'Õigused',
'listgrouprights-helppage'      => 'Help:Rühma õigused',
'listgrouprights-members'       => '(liikmete loend)',
'listgrouprights-right-display' => '$1 ($2)',

# E-mail user
'mailnologin'     => 'Saatja aadress puudub',
'mailnologintext' => 'Te peate olema [[Special:UserLogin|sisse logitud]] ja teil peab [[Special:Preferences|eelistustes]] olema kehtiv e-posti aadress, et saata teistele kasutajatele e-kirju.',
'emailuser'       => 'Saada sellele kasutajale e-kiri',
'emailpage'       => 'Saada kasutajale e-kiri',
'emailpagetext'   => 'Kui see kasutaja on oma eelistuste lehel sisestanud e-posti aadressi, siis saate alloleva vormi kaudu talle kirja saata. Et kasutaja saaks vastata, täidetakse kirja saatja väli "kellelt" e-posti aadressiga, mille olete sisestanud [[Special:Preferences|oma eelistuste lehel]].',
'defemailsubject' => 'E-kiri lehelt {{SITENAME}}',
'noemailtitle'    => 'E-posti aadressi ei ole',
'noemailtext'     => 'See kasutaja ei ole määranud kehtivat e-posti aadressi.',
'emailfrom'       => 'Kellelt:',
'emailto'         => 'Kellele:',
'emailsubject'    => 'Pealkiri:',
'emailmessage'    => 'Sõnum:',
'emailsend'       => 'Saada',
'emailccme'       => 'Saada mulle koopia.',
'emailccsubject'  => 'Koopia sinu sõnumist kasutajale $1: $2',
'emailsent'       => 'E-post saadetud',
'emailsenttext'   => 'Teie sõnum on saadetud.',

# Watchlist
'watchlist'            => 'Jälgimisloend',
'mywatchlist'          => 'Jälgimisloend',
'watchlistfor'         => "('''$1''' jaoks)",
'nowatchlist'          => 'Teie jälgimisloend on tühi.',
'watchlistanontext'    => 'Et näha ja muuta oma jälgimisloendit, peate $1.',
'watchnologin'         => 'Ei ole sisse logitud',
'watchnologintext'     => 'Jälgimisloendi muutmiseks peate [[Special:UserLogin|sisse logima]].',
'addedwatch'           => 'Lisatud jälgimisloendile',
'addedwatchtext'       => 'Lehekülg "<nowiki>$1</nowiki>" on lisatud Teie [[Special:Watchlist|jälgimisloendile]].

Edasised muudatused käesoleval lehel ja sellega seotud aruteluküljel reastatakse jälgimisloendis ning [[Special:RecentChanges|viimaste muudatuste lehel]] tuuakse jälgitava lehe pealkiri esile <b>rasvase</b> kirja abil.

Kui tahad seda lehte hiljem jälgimisloendist eemaldada, klõpsa päisenupule "Lõpeta jälgimine".',
'removedwatch'         => 'Jälgimisloendist kustutatud',
'removedwatchtext'     => 'Artikkel "[[:$1]]" on jälgimisloendist kustutatud.',
'watch'                => 'Jälgi',
'watchthispage'        => 'Jälgi seda artiklit',
'unwatch'              => 'Lõpeta jälgimine',
'unwatchthispage'      => 'Ära jälgi',
'notanarticle'         => 'Pole artikkel',
'notvisiblerev'        => 'Redaktsioon on kustutatud',
'watchnochange'        => 'Valitud perioodi jooksul ei ole üheski jälgitavas artiklis muudatusi tehtud.',
'watchlist-details'    => 'Jälgimisloendis on {{PLURAL:$1|$1 lehekülg|$1 lehekülge}} (ei arvestata arutelulehekülgi).',
'wlheader-enotif'      => '* E-posti teel teavitamine on aktiveeritud.',
'wlheader-showupdated' => "* Leheküljed, mida on muudetud peale sinu viimast külastust, on '''rasvases kirjas'''",
'watchmethod-recent'   => 'jälgitud lehekülgedel tehtud viimaste muudatuste läbivaatamine',
'watchmethod-list'     => 'jälgitavate lehekülgede viimased muudatused',
'watchlistcontains'    => 'Sinu jälgimisloendis on $1 {{PLURAL:$1|artikkel|artiklit}}.',
'iteminvalidname'      => "Probleem üksusega '$1'. Selle nimes on viga.",
'wlnote'               => "Allpool on {{PLURAL:$1|viimane muudatus|viimased '''$1''' muudatust}} viimase {{PLURAL:$2|tunni|'''$2''' tunni}} jooksul.",
'wlshowlast'           => 'Näita viimast $1 tundi $2 päeva. $3',
'watchlist-show-bots'  => 'Näita roboteid',
'watchlist-hide-bots'  => 'Peida robotite parandused',
'watchlist-show-own'   => 'Näita minu redaktsioone',
'watchlist-hide-own'   => 'Peida minu parandused',
'watchlist-show-minor' => 'Näita pisiparandusi',
'watchlist-hide-minor' => 'Peida pisiparandused',

# Displayed when you click the "watch" button and it is in the process of watching
'watching'   => 'jälgin...',
'unwatching' => 'Jälgimise lõpetamine...',

'enotif_reset'                 => 'Märgi kõik lehed loetuks',
'enotif_newpagetext'           => 'See on uus lehekülg.',
'enotif_impersonal_salutation' => '{{SITENAME}} kasutaja',
'changed'                      => 'muudetud',
'created'                      => 'lehekülg loodud',
'enotif_lastvisited'           => 'Kõigi sinu viimase külastuse järel tehtud muudatuste nägemiseks vaata: $1.',
'enotif_lastdiff'              => 'Muudatus on leheküljel $1.',
'enotif_anon_editor'           => 'anonüümne kasutaja $1',

# Delete/protect/revert
'deletepage'                  => 'Kustuta lehekülg',
'confirm'                     => 'Kinnita',
'excontent'                   => "sisu oli: '$1'",
'excontentauthor'             => "sisu oli: '$1' (ja ainuke kirjutaja oli '[[Special:Contributions/$2|$2]]')",
'exbeforeblank'               => "sisu enne lehekülje tühjendamist: '$1'",
'exblank'                     => 'lehekülg oli tühi',
'delete-confirm'              => 'Kustuta "$1"',
'delete-legend'               => 'Kustuta',
'historywarning'              => 'Hoiatus: leheküljel, mida tahate kustutada, on ajalugu:&nbsp;',
'confirmdeletetext'           => 'Sa oled andmebaasist jäädavalt kustutamas lehte või pilti koos kogu tema ajalooga. Palun kinnita, et sa tahad seda tõepoolest teha, et sa mõistad tagajärgi ja et sinu tegevus on kooskõlas siinse [[{{MediaWiki:Policy-url}}|sisekorraga]].',
'actioncomplete'              => 'Toiming sooritatud',
'deletedtext'                 => '"<nowiki>$1</nowiki>" on kustutatud. $2 lehel on nimekiri viimastest kustutatud lehekülgedest.',
'deletedarticle'              => 'kustutas lehekülje "[[$1]]"',
'suppressedarticle'           => 'varjas lehekülje "[[$1]]"',
'dellogpage'                  => 'Kustutatud_leheküljed',
'dellogpagetext'              => 'Allpool on esitatud nimekiri viimastest kustutamistest.
Kõik toodud kellaajad järgivad serveriaega.',
'deletionlog'                 => 'Kustutatud leheküljed',
'reverted'                    => 'Pöörduti tagasi varasemale versioonile',
'deletecomment'               => 'Kustutamise põhjus',
'deleteotherreason'           => 'Muu/täiendav põhjus:',
'deletereasonotherlist'       => 'Muu põhjus',
'deletereason-dropdown'       => '*Harilikud kustutamise põhjused
** Autori palve
** Autoriõiguste rikkumine
** Vandalism',
'delete-edit-reasonlist'      => 'Redigeeri kustutamise põhjuseid',
'delete-toobig'               => 'See lehekülg on pika redigeerimisajalooga – üle {{PLURAL:$1|ühe muudatuse|$1 muudatuse}}.
Selle kustutamine on keelatud, et ära hoida ekslikku võrgukoha {{SITENAME}} töö häirimist.',
'delete-warning-toobig'       => 'See lehekülg on pika redigeerimis ajalooga – üle {{PLURAL:$1|ühe muudatuse|$1 muudatuse}}.
Ettevaatust, selle kustutamine võib esile kutsuda häireid võrgukoha {{SITENAME}} andmebaasi töös.',
'rollback'                    => 'Tühista muudatused',
'rollback_short'              => 'Tühista',
'rollbacklink'                => 'tühista',
'rollbackfailed'              => 'Muudatuste tühistamine ebaõnnestus',
'cantrollback'                => 'Ei saa muudatusi eemaldada, sest viimane kaastööline on artikli ainus autor.',
'editcomment'                 => "Redaktsiooni kokkuvõte: \"''\$1''\".", # only shown if there is an edit comment
'revertpage'                  => 'Tühistati kasutaja [[Special:Contributions/$2|$2]] ([[User talk:$2|arutelu]]) tehtud muudatused ning pöörduti tagasi viimasele muudatusele, mille tegi [[User:$1|$1]]', # Additional available: $3: revid of the revision reverted to, $4: timestamp of the revision reverted to, $5: revid of the revision reverted from, $6: timestamp of the revision reverted from
'rollback-success'            => 'Tühistati $1 muudatus; 
pöörduti tagasi viimasele muudatusele, mille tegi $2.',
'sessionfailure'              => 'Sinu sisselogimisseansiga näib probleem olevat.
See toiming on seansiärandamise vastase ettevaatusabinõuna tühistatud.
Mine tagasi eelmisele leheküljele ja taaslaadi see, seejärel proovi uuesti.',
'protectlogpage'              => 'Kaitsmise logi',
'protectlogtext'              => 'Allpool on loetletud lehekülgede kaitsmised ja kaitsete eemaldamised. Praegu kaitstud lehekülgi vaata [[Special:ProtectedPages|kaitstud lehtede loetelust]].',
'protectedarticle'            => 'kaitses lehekülje "[[$1]]"',
'modifiedarticleprotection'   => 'muutis lehekülje "[[$1]]" kaitsemäära',
'unprotectedarticle'          => 'eemaldas lehekülje "[[$1]]" kaitse',
'protect-title'               => 'Muuda lehekülje "$1" kaitsemäära',
'protect-legend'              => 'Kinnita kaitsmine',
'protectcomment'              => 'Põhjus',
'protectexpiry'               => 'Aegub:',
'protect_expiry_invalid'      => 'Sobimatu aegumise tähtaeg.',
'protect_expiry_old'          => 'Aegumise tähtaeg on minevikus.',
'protect-unchain'             => 'Võimalda lehekülje teisaldamist.',
'protect-text'                => "Siin võite vaadata ja muuta lehekülje '''<nowiki>$1</nowiki>''' kaitsesätteid.",
'protect-locked-blocked'      => "Blokeerituna ei saa muuta kaitstuse taset.
Allpool on toodud lehekülje '''$1''' hetkel kehtivad seaded:",
'protect-locked-dblock'       => "Kaitstuse taset ei saa muuta, sest andmebaas on lukustatud.
Allpool on toodud lehekülje '''$1''' hetkel kehtivad seaded:",
'protect-locked-access'       => "Teie konto ei oma õiguseid muuta lehekülje kaitstuse taset.
Allpool on toodud lehekülje '''$1''' hetkel kehtivad seaded:",
'protect-cascadeon'           => 'See lehekülg on kaitstud, kuna ta on kasutusel {{PLURAL:$1|järgmisel leheküljel|järgmistel lehekülgedel}}, mis on omakorda kaskaadkaitse all.
Sa saad muuta selle lehekülje kaitse staatust, kuid see ei mõjuta kaskaadkaitset.',
'protect-default'             => 'Luba kõigile kasutajatele',
'protect-fallback'            => 'Nõuab "$1" õiguseid',
'protect-level-autoconfirmed' => 'Blokeeri uued ja registreerimata kasutajad',
'protect-level-sysop'         => 'Ainult ülemad',
'protect-summary-cascade'     => 'kaskaad',
'protect-expiring'            => 'aegub $1 (UTC)',
'protect-cascade'             => 'Kaitse lehekülgi, mis on lülitatud käesoleva lehekülje koosseisu (kaskaadkaitse)',
'protect-cantedit'            => 'Te ei saa muuta selle lehekülje kaitstuse taset, sest Teile pole selleks luba antud.',
'restriction-type'            => 'Lubatud:',
'restriction-level'           => 'Kaitsmise tase:',
'minimum-size'                => 'Min suurus',
'maximum-size'                => 'Max suurus:',
'pagesize'                    => '(baiti)',

# Restrictions (nouns)
'restriction-edit'   => 'Redigeerimine',
'restriction-move'   => 'Teisaldamine',
'restriction-create' => 'Loomine',
'restriction-upload' => 'Laadi üles',

# Restriction levels
'restriction-level-sysop'         => 'täielikult kaitstud',
'restriction-level-autoconfirmed' => 'poolkaitstud',
'restriction-level-all'           => 'kõik tasemed',

# Undelete
'undelete'                     => 'Taasta kustutatud lehekülg',
'undeletepage'                 => 'Kuva ja taasta kustutatud lehekülgi',
'undeletepagetitle'            => "'''Kustutatud redaktsioonid leheküljest [[:$1|$1]]'''.",
'viewdeletedpage'              => 'Vaata kustutatud lehekülgi',
'undeletepagetext'             => 'Järgnevad leheküljed on kustutatud, kuis arhiivis
veel olemas, neid saab taastada. Arhiivi sisu vistatakse aegajalt üle parda.',
'undelete-fieldset-title'      => 'Taasta redigeerimised',
'undeleteextrahelp'            => "Kogu lehe ja selle ajaloo taastamiseks jätke kõik linnukesed tühjaks ja vajutage '''''Taasta'''''.
Et taastada valikuliselt, tehke linnukesed kastidesse, mida soovite taastada ja vajutage '''''Taasta'''''.
Nupu '''''Tühjenda''''' vajutamine tühjendab põhjusevälja ja eemaldab kõik linnukesed.",
'undeleterevisions'            => '$1 arhiveeritud {{PLURAL:$1|redaktsioon|redaktsiooni}}.',
'undeletehistory'              => 'Kui taastate lehekülje, taastuvad kõik versioonid artikli ajaloona. 
Kui vahepeal on loodud uus samanimeline lehekülg, ilmuvad taastatud versioonid varasema ajaloona.',
'undeletehistorynoadmin'       => 'See lehekülg on kustutatud.
Kustutamise põhjus ning selle lehekülje kustutamiseelne redigeerimislugu on näha allolevas kokkuvõttes.
Lehekülje kustutamiseelsed redaktsioonid on kättesaadavad ainult ülematele.',
'undeleterevision-missing'     => 'Vigane või puuduv redaktsioon.
Link võib olla kõlbmatu või redaktsioon võib olla taastatud või arhiivist eemaldatud.',
'undelete-nodiff'              => 'Varasemat redaktsiooni ei leidunud.',
'undeletebtn'                  => 'Taasta',
'undeletelink'                 => 'vaata/taasta',
'undeletereset'                => 'Tühjenda',
'undeletecomment'              => 'Põhjus:',
'undeletedarticle'             => '"$1" taastatud',
'undeletedrevisions'           => '$1 {{PLURAL:$1|redaktsioon|redaktsiooni}} taastatud',
'undeletedrevisions-files'     => '{{PLURAL:$1|1 redaktsioon|$1 redaktsiooni}} ja {{PLURAL:$2|1 fail|$2 faili}} taastatud',
'undeletedfiles'               => '{{PLURAL:$1|1 fail|$1 faili}} taastatud',
'cannotundelete'               => 'Taastamine ebaõnnestus; keegi teine võis lehe juba taastada.',
'undeletedpage'                => "<big>'''$1 on taastatud'''</big>

[[Special:Log/delete|Kustutamise logist]] võib leida loendi viimastest kustutamistest ja taastamistest.",
'undelete-header'              => 'Hiljuti kustutatud leheküljed leiad [[Special:Log/delete|kustutamislogist]].',
'undelete-search-box'          => 'Otsi kustutatud lehekülgi',
'undelete-search-prefix'       => 'Näita lehekülgi, mille pealkiri algab nii:',
'undelete-search-submit'       => 'Otsi',
'undelete-no-results'          => 'Kustutatud lehekülgede arhiivist sellist lehekülge ei leidunud.',
'undelete-filename-mismatch'   => 'Failiversiooni ajatempliga $1 ei saa taastada, sest failinimed ei klapi.',
'undelete-bad-store-key'       => 'Failiversiooni ajatempliga $1 ei saa taastada, sest faili ei olnud enne kustutamist.',
'undelete-cleanup-error'       => 'Kasutamata arhiivifaili "$1" kustutamine ebaõnnestus.',
'undelete-missing-filearchive' => 'Failiarhiivi tunnusega $1 ei saa taastada, sest seda pole andmebaasis.
Võimalik, et see on juba taastatud.',
'undelete-error-short'         => 'Faili $1 taastamine ebaõnnestus',
'undelete-error-long'          => 'Faili taastamine ebaõnnestus:

$1',
'undelete-show-file-confirm'   => 'Kas oled kindel, et soovid näha kustutatud versiooni failist <nowiki>$1</nowiki>, mis salvestati $2 kell $3?',
'undelete-show-file-submit'    => 'Jah',

# Namespace form on various pages
'namespace'      => 'Nimeruum:',
'invert'         => 'Näita kõiki peale valitud nimeruumi',
'blanknamespace' => '(Artiklid)',

# Contributions
'contributions' => 'Kasutaja kaastööd',
'mycontris'     => 'Kaastöö',
'contribsub2'   => 'Kasutaja "$1 ($2)" jaoks',
'nocontribs'    => 'Antud kriteeriumile vastavaid muudatusi ei leidnud.',
'uctop'         => ' (üles)',
'month'         => 'Alates kuust (ja varasemad):',
'year'          => 'Alates aastast (ja varasemad):',

'sp-contributions-newbies'     => 'Näita ainult uute kasutajate kaastööd.',
'sp-contributions-newbies-sub' => 'Uued kasutajad',
'sp-contributions-blocklog'    => 'Blokeerimise logi',
'sp-contributions-search'      => 'Otsi kaastöid',
'sp-contributions-username'    => 'IP-aadress või kasutajanimi:',
'sp-contributions-submit'      => 'Otsi',

# What links here
'whatlinkshere'            => 'Lingid siia',
'whatlinkshere-title'      => 'Leheküljed, mis viitavad lehele "$1"',
'whatlinkshere-page'       => 'Lehekülg:',
'linklistsub'              => '(Linkide loend)',
'linkshere'                => "Lehele '''[[:$1]]''' viitavad järgmised leheküljed:",
'nolinkshere'              => "Lehele '''[[:$1]]''' ei viita ükski lehekülg.",
'nolinkshere-ns'           => 'Leheküljele <strong>[[:$1]]</strong> ei ole valitud nimeruumis linke.',
'isredirect'               => 'ümbersuunamislehekülg',
'istemplate'               => 'kasutamine mallina',
'isimage'                  => 'link pildile',
'whatlinkshere-prev'       => '{{PLURAL:$1|eelmised|eelmised $1}}',
'whatlinkshere-next'       => '{{PLURAL:$1|järgmised|järgmised $1}}',
'whatlinkshere-links'      => '← lingid',
'whatlinkshere-hideredirs' => '$1 ümbersuunamised',
'whatlinkshere-hidetrans'  => '$1 mallina kasutamised',
'whatlinkshere-hidelinks'  => '$1 lingid',
'whatlinkshere-hideimages' => '$1 pildilingid',
'whatlinkshere-filters'    => 'Filtrid',

# Block/unblock
'blockip'                     => 'Blokeeri IP-aadress',
'blockip-legend'              => 'Blokeeri kasutaja',
'blockiptext'                 => "See vorm on kirjutamisõiguste blokeerimiseks konkreetselt IP-aadressilt.
'''Seda tohib teha ainult vandalismi vältimiseks ning kooskõlas [[{{MediaWiki:Policy-url}}|{{SITENAME}} sisekorraga]]'''.
Kindlasti tuleb täita ka väli \"põhjus\", paigutades sinna näiteks viited konkreetsetele lehekülgedele, mida rikuti.",
'ipaddress'                   => 'IP-aadress',
'ipadressorusername'          => 'IP-aadress või kasutajanimi',
'ipbexpiry'                   => 'Kehtivus',
'ipbreason'                   => 'Põhjus',
'ipbreasonotherlist'          => 'Muul põhjusel',
'ipbreason-dropdown'          => '*Tavalised blokeerimise põhjused
** Lehtedelt sisu kustutamine
** Sodimine
** Taunitav käitumine, isiklikud rünnakud
** Mittesobiv kasutajanimi
** Spämmi levitamine
** Vale info levitamine',
'ipbanononly'                 => 'Blokeeri ainult anonüümsed kasutajad',
'ipbcreateaccount'            => 'Takista konto loomist',
'ipbemailban'                 => 'Takista kasutajal e-kirjade saatmine',
'ipbenableautoblock'          => 'Blokeeri automaatselt viimane IP-aadress, mida see kasutaja kasutas, ja ka järgnevad, mille alt ta võib proovida kaastööd teha.',
'ipbsubmit'                   => 'Blokeeri see aadress',
'ipbother'                    => 'Muu tähtaeg',
'ipboptions'                  => '2 tundi:2 hours,1 päev:1 day,3 päeva:3 days,1 nädal:1 week,2 nädalat:2 weeks,1 kuu:1 month,3 kuud:3 months,6 kuud:6 months,1 aasta:1 year,igavene:infinite', # display1:time1,display2:time2,...
'ipbotheroption'              => 'muu tähtaeg',
'ipbotherreason'              => 'Muu/täiendav põhjus:',
'ipbhidename'                 => 'Peida kasutajatunnus muudatustest ja loenditest',
'ipbwatchuser'                => 'Jälgi selle kasutaja lehekülge ja arutelu',
'badipaddress'                => 'Vigane IP-aadress',
'blockipsuccesssub'           => 'Blokeerimine õnnestus',
'blockipsuccesstext'          => '[[Special:Contributions/$1|$1]] on blokeeritud.<br />
Kehtivaid blokeeringuid vaata [[Special:IPBlockList|blokeeringute loendist]].',
'ipb-edit-dropdown'           => 'Muuda blokeeringu põhjuseid',
'ipb-unblock-addr'            => 'Kustuta $1 blokeering',
'ipb-unblock'                 => 'Vabasta kasutaja või IP-aadress blokeeringust',
'ipb-blocklist-addr'          => 'Kasutaja $1 blokeeringud',
'ipb-blocklist'               => 'Vaata kehtivaid keelde',
'unblockip'                   => 'Lõpeta IP-aadressi blokeerimine',
'unblockiptext'               => 'Kasutage allpool olevat vormi redigeerimisõiguste taastamiseks varem blokeeritud IP aadressile.',
'ipusubmit'                   => 'Eemalda see blokeering',
'unblocked'                   => 'Kasutaja [[User:$1|$1]] blokeering on eemaldatud',
'unblocked-id'                => 'Blokeerimine $1 on lõpetatud',
'ipblocklist'                 => 'Blokeeritud IP-aadresside ja kasutajakontode loend',
'ipblocklist-legend'          => 'Leia blokeeritud kasutaja',
'ipblocklist-username'        => 'Kasutajanimi või IP-aadress:',
'ipblocklist-submit'          => 'Otsi',
'blocklistline'               => '$1, $2 blokeeris kasutaja $3 ($4)',
'infiniteblock'               => 'igavene',
'expiringblock'               => 'aegub $1',
'anononlyblock'               => 'ainult nimetuna',
'noautoblockblock'            => 'IP-aadressi ei blokita automaatselt',
'createaccountblock'          => 'kontode loomine keelatud',
'emailblock'                  => 'e-kirjade saatmine keelatud',
'ipblocklist-empty'           => 'Blokeerimiste loend on tühi.',
'ipblocklist-no-results'      => 'Nõutud IP-aadress või kasutajatunnus ei ole blokeeritud.',
'blocklink'                   => 'blokeeri',
'unblocklink'                 => 'lõpeta blokeerimine',
'contribslink'                => 'kaastöö',
'autoblocker'                 => 'Automaatselt blokeeritud, kuna [[User:$1|$1]] on hiljuti teie IP-aadressi kasutanud. Põhjus: $2',
'blocklogpage'                => 'Blokeerimise logi',
'blocklogentry'               => 'blokeeris kasutaja [[$1]]. Blokeeringu aegumistähtaeg on $2 $3',
'blocklogtext'                => 'See on kasutajate blokeerimiste ja blokeeringute eemaldamiste nimekiri. Automaatselt blokeeritud IP aadresse siin ei näidata. Hetkel aktiivsete blokeeringute ja redigeerimiskeeldude nimekirja vaata [[Special:IPBlockList|IP blokeeringute nimekirja]] leheküljelt.',
'unblocklogentry'             => 'eemaldas kasutaja $1 blokeeringu',
'block-log-flags-anononly'    => 'ainult anonüümsed kasutajad',
'block-log-flags-nocreate'    => 'kontode loomine on blokeeritud',
'block-log-flags-noautoblock' => 'ei blokeerita automaatselt',
'block-log-flags-noemail'     => 'e-mail blokeeritud',
'range_block_disabled'        => 'Ülema õigus blokeerida IP-aadresside vahemik on ära võetud.',
'ipb_expiry_invalid'          => 'Vigane aegumise tähtaeg.',
'ipb_expiry_temp'             => 'Peidetud kasutajanime blokeeringud peavad olema alalised.',
'ipb_already_blocked'         => '"$1" on juba blokeeritud.',
'ipb_cant_unblock'            => 'Tõrge: Blokeerimis-ID $1 pole leitav.
Blokeering võib juba eemaldatud olla.',
'ipb_blocked_as_range'        => 'Tõrge: IP-aadressi $1 pole eraldi blokeeritud ja blokeeringut ei saa eemaldada.
See kuulub aga blokeeritud IP-vahemikku $2, mille blokeeringut saab eemaldada.',
'ip_range_invalid'            => 'Vigane IP-vahemik.',
'blockme'                     => 'Blokeeri mind',
'proxyblocker-disabled'       => 'See funktsioon ei toimi.',
'proxyblockreason'            => 'Teie IP aadress on blokeeritud, sest see on anonüümne proxy server. Palun kontakteeruga oma internetiteenuse pakkujaga või tehnilise toega ning informeerige neid sellest probleemist.',
'proxyblocksuccess'           => 'Tehtud.',

# Developer tools
'lockdb'              => 'Lukusta andmebaas',
'unlockdb'            => 'Tee andmebaas lukust lahti',
'lockdbtext'          => 'Andmebaasi lukustamine peatab kõigi kasutajate võimaluse muuta lehtekülgi, oma eelistusi ja jälgimisloendit ning teha teisi toiminguid, mis vajavad muudatusi andmebaasis.
Palun kinnitage, et te soovite seda teha ja et avate andmebaasi, kui hööldustööd on tehtud.',
'unlockdbtext'        => 'Andmebaasi lukust lahti tegemine taastab kõigi kasutajate võimaluse toimetada lehekülgi, muuta oma eelistusi, toimetada oma jälgimisloendeid ja muud, mis nõuab muudatusi andmebaasis.
Palun kinnita, et sa tahad seda teha.',
'lockconfirm'         => 'Jah, ma soovin andmebaasi lukustada.',
'unlockconfirm'       => 'Jah, ma tõesti soovin andmebaasi lukust avada.',
'lockbtn'             => 'Võta andmebaas kirjutuskaitse alla',
'unlockbtn'           => 'Taasta andmebaasi kirjutuspääs',
'locknoconfirm'       => 'Sa ei märkinud kinnituskastikesse linnukest.',
'lockdbsuccesssub'    => 'Andmebaas kirjutuskaitse all',
'unlockdbsuccesssub'  => 'Kirjutuspääs taastatud',
'lockdbsuccesstext'   => 'Andmebaas on nüüd kirjutuskaitse all.
<br />Kui Teie hooldustöö on läbi, ärge unustage kirjutuspääsu taastada!',
'unlockdbsuccesstext' => 'Andmebaasi kirjutuspääs on taastatud.',
'databasenotlocked'   => 'Andmebaas ei ole lukustatud.',

# Move page
'move-page'               => 'Teisalda $1',
'move-page-legend'        => 'Teisalda artikkel',
'movepagetext'            => "Allolevat vormi kasutades saate lehekülje ümber nimetada.
Lehekülje ajalugu tõstetakse uue pealkirja alla automaatselt.
Praeguse pealkirjaga leheküljest saab ümbersuunamisleht uuele leheküljele.
Teistes artiklites olevaid linke praeguse nimega leheküljele automaatselt ei muudeta.
Teie kohuseks on hoolitseda, et ei tekiks topeltümbersuunamisi ning et kõik jääks toimima nagu enne ümbernimetamist.

Lehekülge '''ei nimetata ümber''' juhul, kui uue nimega lehekülg on juba olemas. Erandiks on juhud, kui olemasolev lehekülg on tühi või ümbersuunamislehekülg ja sellel pole redigeerimisajalugu.
See tähendab, et te ei saa kogemata üle kirjutada juba olemasolevat lehekülge, kuid saate ebaõnnestunud ümbernimetamise tagasi pöörata.

'''ETTEVAATUST!'''
Võimalik, et kavatsete teha ootamatut ning drastilist muudatust väga loetavasse artiklisse;
enne muudatuse tegemist mõelge palun järele, mis võib olla selle tagajärjeks.",
'movepagetalktext'        => "Koos artiklileheküljega teisaldatakse automaatselt ka arutelulehekülg, '''välja arvatud juhtudel, kui:'''
*liigutate lehekülge ühest nimeruumist teise,
*uue nime all on juba olemas mittetühi arutelulehekülg või
*jätate alumise kastikese märgistamata.

Neil juhtudel teisaldage arutelulehekülg soovi korral eraldi või ühendage ta omal käel uue aruteluleheküljega.",
'movearticle'             => 'Teisalda artiklilehekülg',
'movenotallowed'          => 'Sul ei ole lehekülgede teisaldamise õigust.',
'newtitle'                => 'Uue pealkirja alla',
'move-watch'              => 'Jälgi seda lehekülge',
'movepagebtn'             => 'Teisalda artikkel',
'pagemovedsub'            => 'Artikkel on teisaldatud',
'movepage-moved'          => '<big>\'\'\'"$1" teisaldatud pealkirja "$2" alla\'\'\'</big>', # The two titles are passed in plain text as $3 and $4 to allow additional goodies in the message.
'articleexists'           => 'Selle nimega artikkel on juba olemas või pole valitud nimi lubatav. Palun valige uus nimi.',
'cantmove-titleprotected' => 'Lehte ei saa sinna teisaldada, sest uus pealkiri on artikli loomise eest kaitstud',
'talkexists'              => 'Artikkel on teisaldatud, kuid arutelulehekülge ei saanud teisaldada, sest uue nime all on arutelulehekülg juba olemas. Palun ühendage aruteluleheküljed ise.',
'movedto'                 => 'Teisaldatud pealkirja alla:',
'movetalk'                => 'Teisalda ka "arutelu", kui saab.',
'movepage-page-exists'    => 'Lehekülg $1 on juba olemas ja seda ei saa automaatselt üle kirjutada.',
'movepage-page-moved'     => 'Lehekülg $1 on teisaldatud pealkirja $2 alla.',
'movepage-page-unmoved'   => 'Lehekülge $1 ei saanud teisaldada pealkirja $2 alla.',
'movepage-max-pages'      => 'Teisaldatud on $1 {{PLURAL:$1|lehekülg|lehekülge}}, mis on teisaldatavate lehekülgede ülemmäär. Rohkem lehekülgi automaatselt ei teisaldata.',
'1movedto2'               => 'teisaldas lehekülje [[$1]] pealkirja [[$2]] alla',
'1movedto2_redir'         => 'teisaldas lehekülje [[$1]] ümbersuunamisega pealkirja [[$2]] alla',
'movelogpage'             => 'Teisaldamise logi',
'movelogpagetext'         => 'See logi sisaldab infot lehekülgede teisaldamistest.',
'movereason'              => 'Põhjus',
'revertmove'              => 'taasta',
'delete_and_move'         => 'Kustuta ja teisalda',
'delete_and_move_text'    => '== Vajalik kustutamine ==
Sihtlehekülg "[[:$1]]" on juba olemas.
Kas kustutad selle, et luua võimalus teisaldamiseks?',
'delete_and_move_confirm' => 'Jah, kustuta lehekülg',
'delete_and_move_reason'  => 'Kustutatud, et asemele tõsta teine lehekülg',
'imagenocrossnamespace'   => 'Faili ei saa teisaldada mõnda muusse nimeruumi',
'imagetypemismatch'       => 'Uus faililaiend ei sobi selle tüübiga',
'imageinvalidfilename'    => 'Sihtmärgi nimi on vigane',
'fix-double-redirects'    => 'Värskenda kõik siia viitavad ümbersuunamislehed uuele pealkirjale',

# Export
'export'            => 'Lehekülgede eksport',
'exporttext'        => 'Sa saad siin eksportida kindla lehekülje või nende kogumi, tekstid, koos kogu nende muudatuste ajalooga, XML kujule viiduna. Seda saad sa vajadusel kasutada teksti ülekandmiseks teise vikisse, kasutades selleks MediaWiki [[Special:Import|impordi lehekülge]].

Et eksportida lehekülgi, sisesta nende pealkirjad all olevasse teksti kasti, iga pealkiri ise reale, ning vali kas sa soovid saada leheküljest kõiki selle vanemaid versioone (muudatusi) või soovid sa saada leheküljest vaid hetke versiooni.

Viimasel juhul võid sa näiteks "[[{{MediaWiki:Mainpage}}]]" lehekülje, jaoks kasutada samuti linki kujul:  [[{{#Special:Export}}/{{MediaWiki:Mainpage}}]].',
'exportcuronly'     => 'Lisa vaid viimane versioon lehest, ning mitte kogu ajalugu',
'exportnohistory'   => "----
'''Märkus:''' Lehekülgede täieliku ajaloo eksportimine on siin leheküljel jõudluse tagamiseks blokeeritud.",
'export-submit'     => 'Ekspordi',
'export-addcattext' => 'Kõik leheküljed kategooriast:',
'export-addcat'     => 'Lisa',
'export-download'   => 'Salvesta failina',
'export-templates'  => 'Kaasa mallid',

# Namespace 8 related
'allmessages'               => 'Kõik süsteemi sõnumid',
'allmessagesname'           => 'Nimi',
'allmessagesdefault'        => 'Vaikimisi tekst',
'allmessagescurrent'        => 'Praegune tekst',
'allmessagestext'           => 'See on loend kõikidest kättesaadavatest süsteemi sõnumitest MediaWiki: nimeruumis.
Kui soovid MediaWiki tarkvara tõlkimises osaleda siis vaata lehti [http://www.mediawiki.org/wiki/Localisation MediaWiki Lokaliseerimine] ja [http://translatewiki.net translatewiki.net].',
'allmessagesnotsupportedDB' => "Seda lehekülge ei saa kasutada, sest '''\$wgUseDatabaseMessages''' ei tööta.",
'allmessagesfilter'         => 'Sõnuminimefilter:',
'allmessagesmodified'       => 'Näita ainult muudetuid',

# Thumbnails
'thumbnail-more'           => 'Suurenda',
'filemissing'              => 'Fail puudub',
'thumbnail_error'          => 'Viga pisipildi loomisel: $1',
'thumbnail_invalid_params' => 'Vigased pisipildi parameetrid',

# Special:Import
'import'                     => 'Lehekülgede import',
'importinterwiki'            => 'Vikidevaheline import',
'import-interwiki-text'      => 'Vali importimiseks viki ja lehekülje pealkiri.
Redigeerimisajad ja toimetajate nimed säilitatakse.
Kõik vikide vahelised toimingud on [[Special:Log/import|impordilogis]].',
'import-interwiki-history'   => 'Kopeeri selle lehekülje kogu ajalugu',
'import-interwiki-submit'    => 'Impordi',
'import-interwiki-namespace' => 'Sihtpunkti nimeruum:',
'importtext'                 => 'Palun kasuta faili eksportimiseks allikaks olevast vikist [[Special:Export|ekspordi vahendit]]. Salvesta see oma arvutisse laadi siia üles.',
'importstart'                => 'Impordin lehekülgi...',
'import-revision-count'      => '$1 {{PLURAL:$1|versioon|versiooni}}',
'importnopages'              => 'Ei olnud imporditavaid lehekülgi.',
'importfailed'               => 'Importimine ebaõnnestus: <nowiki>$1</nowiki>',
'importunknownsource'        => 'Unknown import source type
Tundmatu tüüpi algallikas',
'importcantopen'             => 'Ei saa imporditavat faili avada',
'importbadinterwiki'         => 'Vigane interwiki link',
'importnotext'               => 'Tühi või ilma tekstita',
'importsuccess'              => 'Importimine edukalt lõpetatud!',
'importhistoryconflict'      => 'Konfliktne muudatuste ajalugu (võimalik, et seda lehekülge juba varem imporditud)',
'importnosources'            => 'Ühtegi transwiki impordiallikat ei ole defineeritud ning ajaloo otseimpordi funktsioon on välja lülitatud.',
'importnofile'               => 'Ühtegi imporditavat faili ei laaditud üles.',
'importuploaderrorsize'      => 'Üleslaaditava faili import ebaõnnestus.
Fail on lubatust suurem.',
'importuploaderrorpartial'   => 'Imporditava faili üleslaadimine ebaõnnestus.
Fail oli vaid osaliselt üleslaaditud.',
'importuploaderrortemp'      => 'Üleslaaditava faili import ebaõnnestus.
Puudub ajutine kataloog.',
'import-noarticle'           => 'Ühtki lehekülge polnud importida!',
'import-nonewrevisions'      => 'Kõik versioonid on eelnevalt imporditud.',
'import-token-mismatch'      => 'Seansiandmed läksid kaduma.
Palun ürita uuesti.',
'import-invalid-interwiki'   => 'Määratud vikist ei saa importida.',

# Import log
'importlogpage'                    => 'Impordilogi',
'importlogpagetext'                => 'Importimislogi kuvab leheküljed, mille redigeerimisajalugu pärineb teistest vikidest.',
'import-logentry-upload'           => 'importis faili üleslaadimisega lehekülje [[$1]]',
'import-logentry-upload-detail'    => '$1 {{PLURAL:$1|redaktsioon|redaktsiooni}}',
'import-logentry-interwiki'        => 'importis teisest vikist lehekülje $1',
'import-logentry-interwiki-detail' => '$1 {{PLURAL:$1|redaktsioon|redaktsiooni}} vikist $2',

# Tooltip help for the actions
'tooltip-pt-userpage'             => 'Sinu kasutajaleht',
'tooltip-pt-anonuserpage'         => 'Selle IP aadressi kasutajaleht',
'tooltip-pt-mytalk'               => 'Minu aruteluleht',
'tooltip-pt-anontalk'             => 'Arutelu sellelt IP aadressilt tehtud muudatuste kohta',
'tooltip-pt-preferences'          => 'Minu eelistused',
'tooltip-pt-watchlist'            => 'Lehekülgede loend, mida jälgid muudatuste osas',
'tooltip-pt-mycontris'            => 'Sinu kaastööde loend',
'tooltip-pt-login'                => 'Me julgustame teid sisse logima, kuid see pole kohustuslik.',
'tooltip-pt-anonlogin'            => 'Me julgustame teid sisse logima, kuid see pole kohustuslik.',
'tooltip-pt-logout'               => 'Logi välja',
'tooltip-ca-talk'                 => 'Selle artikli arutelu',
'tooltip-ca-edit'                 => 'Te võite seda lehekülge redigeerida. Palun kasutage enne salvestamist eelvaadet.',
'tooltip-ca-addsection'           => 'Lisa uus alaosa',
'tooltip-ca-viewsource'           => 'See lehekülg on kaitstud. Te võite kuvada selle koodi.',
'tooltip-ca-history'              => 'Selle lehekülje varasemad versioonid.',
'tooltip-ca-protect'              => 'Kaitse seda lehekülge',
'tooltip-ca-delete'               => 'Kustuta see lehekülg',
'tooltip-ca-undelete'             => 'Taasta tehtud muudatused enne kui see lehekülg kustutati',
'tooltip-ca-move'                 => 'Teisalda see lehekülg teise nime alla.',
'tooltip-ca-watch'                => 'Lisa see lehekülg oma jälgimisloendile',
'tooltip-ca-unwatch'              => 'Eemalda see lehekülg oma jälgimisloendist',
'tooltip-search'                  => 'Otsi vikist',
'tooltip-search-go'               => 'Siirdutakse täpselt sellist pealkirja kandvale lehele (kui selline on olemas)',
'tooltip-search-fulltext'         => 'Otsitakse teksti sisaldavaid artikleid',
'tooltip-p-logo'                  => 'Esileht',
'tooltip-n-mainpage'              => 'Mine esilehele',
'tooltip-n-portal'                => 'Projekti kohta, mida te saate teha, kuidas leida informatsiooni jne',
'tooltip-n-currentevents'         => 'Leia informatsiooni sündmuste kohta maailmas',
'tooltip-n-recentchanges'         => 'Vikis tehtud viimaste muudatuste loend.',
'tooltip-n-randompage'            => 'Mine juhuslikule leheküljele',
'tooltip-n-help'                  => 'Kuidas redigeerida.',
'tooltip-t-whatlinkshere'         => 'Kõik viki leheküljed, mis siia viitavad',
'tooltip-t-recentchangeslinked'   => 'Viimased muudatused lehekülgedel, milledele on siit viidatud',
'tooltip-feed-rss'                => 'Selle lehekülje RSS-toide',
'tooltip-feed-atom'               => 'Selle lehekülje Atom-toide',
'tooltip-t-contributions'         => 'Kuva selle kasutaja kaastööd',
'tooltip-t-emailuser'             => 'Saada sellele kasutajale e-kiri',
'tooltip-t-upload'                => 'Laadi faile üles',
'tooltip-t-specialpages'          => 'Erilehekülgede loend',
'tooltip-t-print'                 => 'Selle lehe trükiversioon',
'tooltip-t-permalink'             => 'Püsilink lehe sellele versioonile',
'tooltip-ca-nstab-main'           => 'Näita artiklit',
'tooltip-ca-nstab-user'           => 'Näita kasutaja lehte',
'tooltip-ca-nstab-media'          => 'Näita pildi lehte',
'tooltip-ca-nstab-special'        => 'See on erilehekülg, te ei saa seda redigeerida',
'tooltip-ca-nstab-project'        => 'Näita projekti lehte',
'tooltip-ca-nstab-image'          => 'Näita pildi lehte',
'tooltip-ca-nstab-mediawiki'      => 'Näita süsteemi sõnumit',
'tooltip-ca-nstab-template'       => 'Näita malli',
'tooltip-ca-nstab-help'           => 'Näita abilehte',
'tooltip-ca-nstab-category'       => 'Näita kategooria lehte',
'tooltip-minoredit'               => 'Märgista see pisiparandusena',
'tooltip-save'                    => 'Salvesta muudatused',
'tooltip-preview'                 => 'Näita tehtavaid muudatusi. Palun kasutage seda enne salvestamist!',
'tooltip-diff'                    => 'Näita tehtavaid muudatusi.',
'tooltip-compareselectedversions' => 'Näita erinevusi kahe selle lehe valitud versiooni vahel.',
'tooltip-watch'                   => 'Lisa see lehekülg oma jälgimisloendile',
'tooltip-recreate'                => 'Taasta kustutatud lehekülg',
'tooltip-upload'                  => 'Alusta üleslaadimist',

# Metadata
'nodublincore'      => "Dublin Core'i RDF-meta-andmed ei ole selles serveris lubatud.",
'nocreativecommons' => 'Creative Commonsi RDF-meta-andmed ei ole selles serveris lubatud.',
'notacceptable'     => 'Viki server ei saa esitada andmeid formaadis, mida sinu veebiklient lugeda suudab.',

# Attribution
'anonymous'        => '{{SITENAME}} anonüümsed kasutajad',
'siteuser'         => 'viki kasutaja $1',
'lastmodifiedatby' => 'Viimati muutis lehekülge $3 $2 kell $1.', # $1 date, $2 time, $3 user
'othercontribs'    => 'Põhineb kasutajate $1 tööl.',
'others'           => 'teised',
'siteusers'        => 'Viki kasutaja(d) $1',
'creditspage'      => 'Lehekülje toimetajate loend',
'nocredits'        => 'Selle lehekülje toimetajate loend ei ole kättesaadav.',

# Spam protection
'spamprotectiontitle' => 'Spämmitõrjefilter',
'spamprotectiontext'  => 'Rämpspostifilter oli lehekülje, mida sa salvestada tahtsid, blokeerinud.
See on ilmselt põhjustatud linkimisest mustas nimekirjas olevasse välisvõrgukohta.',
'spamprotectionmatch' => 'Järgnev tekst vallandas meie rämpspostifiltri: $1',
'spam_blanking'       => 'Kõik versioonid sisaldasid linke veebilehele $1. Lehekülg tühjendatud.',

# Info page
'infosubtitle'   => 'Lehekülje informatsioon',
'numedits'       => 'Lehekülje redigeerimiste arv: $1',
'numtalkedits'   => 'Arutelulehe redigeerimiste arv: $1',
'numwatchers'    => 'Jälgijate arv: $1',
'numauthors'     => 'Lehekülje erinevate toimetajate arv: $1',
'numtalkauthors' => 'Arutelulehe erinevate toimetajate arv: $1',

# Math options
'mw_math_png'    => 'Alati PNG',
'mw_math_simple' => 'Kui väga lihtne, siis HTML, muidu PNG',
'mw_math_html'   => 'Võimaluse korral HTML, muidu PNG',
'mw_math_source' => 'Säilitada TeX (tekstibrauserite puhul)',
'mw_math_modern' => 'Soovitatav moodsate brauserite puhul',
'mw_math_mathml' => 'MathML',

# Patrolling
'markaspatrolleddiff'                 => 'Märgi kui kontrollitud',
'markaspatrolledtext'                 => 'Märgi see leht kontrollituks',
'markedaspatrolled'                   => 'Kontrollituks märgitud',
'markedaspatrolledtext'               => 'Valitud redaktsioon on märgitud kontrollituks.',
'rcpatroldisabled'                    => 'Viimaste muudatuste kontroll ei toimi',
'rcpatroldisabledtext'                => 'Viimaste muudatuste kontrolli tunnus ei toimi hetkel.',
'markedaspatrollederror'              => 'Ei saa kontrollituks märkida',
'markedaspatrollederrortext'          => 'Vajalik on määrata, milline versioon märkida kontrollituks.',
'markedaspatrollederror-noautopatrol' => 'Enda muudatusi ei saa kontrollituks märkida.',

# Patrol log
'patrol-log-page'   => 'Kontrollimise logi',
'patrol-log-header' => 'See on kontrollitud redaktsioonide logi.',
'patrol-log-line'   => 'märkis $1 leheküljel $2 kontrollituks $3',
'patrol-log-auto'   => '(automaatne)',
'patrol-log-diff'   => 'versiooni $1',

# Image deletion
'deletedrevision'                 => 'Kustutatud vanem variant $1',
'filedeleteerror-short'           => 'Faili $1 kustutamine ebaõnnestus',
'filedeleteerror-long'            => 'Faili kustutamine ebaõnnestus:

$1',
'filedelete-missing'              => 'Faili "$1" ei saa kustutada, sest seda ei ole.',
'filedelete-old-unregistered'     => 'Etteantud failiversiooni "$1" pole andmebaasis.',
'filedelete-current-unregistered' => 'Fail "$1" ei ole andmebaasis.',

# Browsing diffs
'previousdiff' => '← Eelmised erinevused',
'nextdiff'     => 'Järgmised erinevused →',

# Media information
'mediawarning'         => "'''Hoiatus''': See fail võib sisaldada pahatahtlikku koodi, mille käivitamime võib kahjustada teie arvutisüsteemi.<hr />",
'imagemaxsize'         => "Maksimaalne pildi suurus:<br />''(faili kirjeldusleheküljel)''",
'thumbsize'            => 'Pisipildi suurus:',
'widthheightpage'      => '$1×$2, $3 {{PLURAL:$3|lehekülg|lehekülge}}',
'file-info'            => '(faili suurus: $1, MIME tüüp: $2)',
'file-info-size'       => '($1 × $2 pikslit, faili suurus: $3, MIME tüüp: $4)',
'file-nohires'         => '<small>Sellest suuremat pilti pole.</small>',
'svg-long-desc'        => '(SVG fail, algsuurus $1 × $2 pikslit, faili suurus: $3)',
'show-big-image'       => 'Originaalsuurus',
'show-big-image-thumb' => '<small>Selle eelvaate suurus on: $1 × $2 pikselit</small>',

# Special:NewImages
'newimages'             => 'Uute meediafailide galerii',
'imagelisttext'         => "
Järgnevas loendis, mis on sorteeritud $2, on '''$1''' {{PLURAL:$1|fail|faili}}.",
'newimages-summary'     => 'Sellel erilehel on viimati üles laaditud failid.',
'showhidebots'          => '($1 robotite kaastööd)',
'noimages'              => 'Uusi pilte ei ole.',
'ilsubmit'              => 'Otsi',
'bydate'                => 'kuupäeva järgi',
'sp-newimages-showfrom' => 'Näita uusi faile alates $2 $1',

# Bad image list
'bad_image_list' => 'Arvesse võetakse ainult nimekirja ühikud (read, mis algavad sümboliga *).
Esimene link real peab olema link kõlbmatule failile.
Samal real olevaid järgmiseid linke vaadeldakse kui erandeid, see tähendab artikleid, mille koosseisu kujutise võib lülitada.',

# Metadata
'metadata'          => 'Metaandmed',
'metadata-help'     => 'See fail sisaldab lisateavet, mille on tõenäoliselt lisanud digikaamera või skanner.
Kui faili on rakendustarkvaraga töödeldud, võib osa andmeid olla muudetud või täielikult eemaldatud.',
'metadata-expand'   => 'Näita täpsemaid detaile',
'metadata-collapse' => 'Peida täpsemad detailid',
'metadata-fields'   => 'Siin loetletud EXIF metaandmete välju näidatakse pildi kirjelduslehel vähemdetailse metaandmete vaate korral.
Ülejäänud andmed on vaikimisi peidetud.
* make
* model
* datetimeoriginal
* exposuretime
* fnumber
* isospeedratings
* focallength', # Do not translate list items

# EXIF tags
'exif-imagewidth'                  => 'Laius',
'exif-imagelength'                 => 'Kõrgus',
'exif-bitspersample'               => 'Bitti komponendi kohta',
'exif-compression'                 => 'Pakkimise skeem',
'exif-photometricinterpretation'   => 'Pikslite koosseis',
'exif-orientation'                 => 'Orientatsioon',
'exif-samplesperpixel'             => 'Komponentide arv',
'exif-planarconfiguration'         => 'Andmejärjestus',
'exif-xresolution'                 => 'Horisontaalne eraldus',
'exif-yresolution'                 => 'Vertikaalne eraldus',
'exif-resolutionunit'              => 'X ja Y resolutsiooni ühik',
'exif-stripoffsets'                => 'Pildi andmete asukoht',
'exif-jpeginterchangeformat'       => 'Kaugus JPEG SOI-ni',
'exif-jpeginterchangeformatlength' => 'JPEG-andmete suurus baitides',
'exif-transferfunction'            => 'Siirdefunktsioon',
'exif-whitepoint'                  => 'Valge punkti heledus',
'exif-datetime'                    => 'Faili muutmise kuupäev ja kellaaeg',
'exif-imagedescription'            => 'Pildi pealkiri',
'exif-make'                        => 'Kaamera tootja',
'exif-model'                       => 'Kaamera mudel',
'exif-software'                    => 'Kasutatud tarkvara',
'exif-artist'                      => 'Autor',
'exif-copyright'                   => 'Autoriõiguste omanik',
'exif-exifversion'                 => 'Exif versioon',
'exif-flashpixversion'             => 'Toetatud Flashpixi versioon',
'exif-colorspace'                  => 'Värviruum',
'exif-componentsconfiguration'     => 'Iga komponendi tähendus',
'exif-compressedbitsperpixel'      => 'Pildi pakkimise meetod',
'exif-pixelydimension'             => 'Kehtiv pildi laius',
'exif-pixelxdimension'             => 'Kehtiv pildi kõrgus',
'exif-makernote'                   => 'Tootja märkmed',
'exif-usercomment'                 => 'Kasutaja kommentaarid',
'exif-relatedsoundfile'            => 'Seotud helifail',
'exif-datetimeoriginal'            => 'Andmete loomise kuupäev ja kellaaeg',
'exif-datetimedigitized'           => 'Digitaliseerimise kuupäev ja kellaaeg',
'exif-subsectime'                  => 'Kuupäev/Kellaaeg sekundi murdosad',
'exif-subsectimeoriginal'          => 'Loomisaja sekundi murdosad',
'exif-subsectimedigitized'         => 'Digiteerimise sekundi murdosad',
'exif-exposuretime'                => 'Säriaeg',
'exif-exposuretime-format'         => '$1 sek ($2)',
'exif-exposureprogram'             => 'Säriprogramm',
'exif-spectralsensitivity'         => 'Spektraalne tundlikkus',
'exif-isospeedratings'             => 'Kiirus (ISO)',
'exif-shutterspeedvalue'           => 'Katiku kiirus',
'exif-aperturevalue'               => 'Avaarv',
'exif-brightnessvalue'             => 'Heledus',
'exif-exposurebiasvalue'           => 'Särituse mõju',
'exif-subjectdistance'             => 'Subjekti kaugus',
'exif-lightsource'                 => 'Valgusallikas',
'exif-flash'                       => 'Välk',
'exif-focallength'                 => 'Fookuskaugus',
'exif-flashenergy'                 => 'Välgu võimsus',
'exif-subjectlocation'             => 'Subjekti asukoht',
'exif-exposureindex'               => 'Särituse number',
'exif-filesource'                  => 'Faili päritolu',
'exif-customrendered'              => 'Kohandatud pilditöötlus',
'exif-exposuremode'                => 'Särituse meetod',
'exif-whitebalance'                => 'Valge tasakaal',
'exif-digitalzoomratio'            => 'Digisuumi tegur',
'exif-contrast'                    => 'Kontrastsus',
'exif-saturation'                  => 'Küllastus',
'exif-sharpness'                   => 'Teravus',
'exif-devicesettingdescription'    => 'Seadme seadistuste kirjeldus',
'exif-imageuniqueid'               => 'Üksiku pildi ID',
'exif-gpsversionid'                => 'GPS tähise versioon',
'exif-gpslatituderef'              => 'Põhja- või lõunapikkus',
'exif-gpslatitude'                 => 'Laius',
'exif-gpslongituderef'             => 'Ida- või läänepikkus',
'exif-gpslongitude'                => 'Laiuskraad',
'exif-gpsaltituderef'              => 'Viide kõrgusele merepinnast',
'exif-gpsaltitude'                 => 'Kõrgus merepinnast',
'exif-gpstimestamp'                => 'GPS aeg (aatomikell)',
'exif-gpssatellites'               => 'Mõõtmiseks kasutatud satelliidid',
'exif-gpsstatus'                   => 'Vastuvõtja olek',
'exif-gpsmeasuremode'              => 'Mõõtmise meetod',
'exif-gpsdop'                      => 'Mõõtmise täpsus',
'exif-gpsspeedref'                 => 'Kiirusühik',
'exif-gpsspeed'                    => 'GPS-vastuvõtja kiirus',
'exif-gpstrack'                    => 'Liikumise suund',
'exif-gpsimgdirection'             => 'Pildi suund',
'exif-gpsdestdistance'             => 'Sihtmärgi kaugus',
'exif-gpsdatestamp'                => 'GPS kuupäev',

# EXIF attributes
'exif-compression-1' => 'Pakkimata',

'exif-unknowndate' => 'Kuupäev teadmata',

'exif-orientation-1' => 'Normaalne', # 0th row: top; 0th column: left
'exif-orientation-2' => 'Pööratud pikali', # 0th row: top; 0th column: right
'exif-orientation-3' => 'Pööratud 180°', # 0th row: bottom; 0th column: right
'exif-orientation-4' => 'Pööratud püsti', # 0th row: bottom; 0th column: left
'exif-orientation-5' => 'Pööratud 90° vastupäeva ja püstselt ümberpööratud', # 0th row: left; 0th column: top
'exif-orientation-6' => 'Pööratud 90° päripäeva', # 0th row: right; 0th column: top
'exif-orientation-7' => 'Pööratud 90° päripäeva ja püstselt ümberpööratud', # 0th row: right; 0th column: bottom
'exif-orientation-8' => 'Pööratud 90° vastupäeva', # 0th row: left; 0th column: bottom

'exif-componentsconfiguration-0' => 'ei ole',

'exif-exposureprogram-0' => 'Määratlemata',
'exif-exposureprogram-1' => 'Manuaalne',
'exif-exposureprogram-2' => 'Tavaprogramm',
'exif-exposureprogram-3' => 'Ava prioriteet',
'exif-exposureprogram-4' => 'Katiku prioriteet',
'exif-exposureprogram-7' => 'Portree töörežiim (lähifotode jaoks, taust fookusest väljas)',
'exif-exposureprogram-8' => 'Maastiku töörežiim (maastikupiltide jaoks, taust on fokuseeritud)',

'exif-subjectdistance-value' => '$1 meetrit',

'exif-meteringmode-0'   => 'Teadmata',
'exif-meteringmode-1'   => 'Keskmine',
'exif-meteringmode-2'   => 'Kaalutud keskmine',
'exif-meteringmode-3'   => 'Punkt',
'exif-meteringmode-4'   => 'Mitmikpunkt',
'exif-meteringmode-5'   => 'Muster',
'exif-meteringmode-6'   => 'Osaline',
'exif-meteringmode-255' => 'Muu',

'exif-lightsource-0'   => 'Teadmata',
'exif-lightsource-1'   => 'Päevavalgus',
'exif-lightsource-2'   => 'Helendav',
'exif-lightsource-3'   => 'Hõõglambi valgus',
'exif-lightsource-4'   => 'Välk',
'exif-lightsource-9'   => 'Hea ilm',
'exif-lightsource-10'  => 'Pilvine ilm',
'exif-lightsource-11'  => 'Varjus',
'exif-lightsource-12'  => 'Luminofoor päevavalgus (D 5700 - 7100K)',
'exif-lightsource-13'  => 'Luminofoor päevavalgus (N 4600 - 5400K)',
'exif-lightsource-14'  => 'Luminofoor külm valgus (W 3900 - 4500K)',
'exif-lightsource-15'  => 'Luminofoor valge (WW 3200 - 3700K)',
'exif-lightsource-17'  => 'Standardne valgus A',
'exif-lightsource-18'  => 'Standardne valgus B',
'exif-lightsource-19'  => 'Standardne valgus C',
'exif-lightsource-24'  => 'stuudio hõõglambid (ISO)',
'exif-lightsource-255' => 'Muu valgusallikas',

'exif-focalplaneresolutionunit-2' => 'tolli',

'exif-sensingmethod-1' => 'Määramata',
'exif-sensingmethod-2' => 'Ühe-kiibiga värvisensor',
'exif-sensingmethod-3' => 'Kahe-kiibiga värvisensor',
'exif-sensingmethod-4' => 'Kolme-kiibiga värvisensor',
'exif-sensingmethod-7' => 'Kolmerealine sensor',

'exif-exposuremode-0' => 'Automaatne säritus',
'exif-exposuremode-1' => 'Manuaalne säritus',

'exif-whitebalance-1' => 'Manuaalne valgusbalanss',

'exif-scenecapturetype-1' => 'Maastik',
'exif-scenecapturetype-2' => 'Portree',
'exif-scenecapturetype-3' => 'Ööpilt',

'exif-gaincontrol-0' => 'Ei ole',
'exif-gaincontrol-1' => 'Aeglane tõus',
'exif-gaincontrol-2' => 'Kiire tõus',

'exif-contrast-0' => 'Normaalne',
'exif-contrast-1' => 'Pehme',
'exif-contrast-2' => 'Kõva',

'exif-saturation-0' => 'Normaalne',
'exif-saturation-1' => 'Madal värviküllastus',
'exif-saturation-2' => 'Kõrge värviküllastus',

'exif-sharpness-0' => 'Normaalne',
'exif-sharpness-1' => 'Pehme',
'exif-sharpness-2' => 'Kõva',

'exif-subjectdistancerange-0' => 'Teadmata',
'exif-subjectdistancerange-1' => 'Makro',
'exif-subjectdistancerange-2' => 'Lähivõte',
'exif-subjectdistancerange-3' => 'Kaugvõte',

# Pseudotags used for GPSLatitudeRef and GPSDestLatitudeRef
'exif-gpslatitude-n' => 'Põhjalaius',
'exif-gpslatitude-s' => 'Lõunalaius',

# Pseudotags used for GPSLongitudeRef and GPSDestLongitudeRef
'exif-gpslongitude-e' => 'Idapikkus',
'exif-gpslongitude-w' => 'Läänepikkus',

'exif-gpsstatus-a' => 'Mõõtmine pooleli',

'exif-gpsmeasuremode-2' => '2-mõõtmeline ulatus',
'exif-gpsmeasuremode-3' => '3-mõõtmeline ulatus',

# Pseudotags used for GPSSpeedRef and GPSDestDistanceRef
'exif-gpsspeed-k' => 'Kilomeetrit tunnis',
'exif-gpsspeed-m' => 'Miili tunnis',
'exif-gpsspeed-n' => 'Sõlme',

# Pseudotags used for GPSTrackRef, GPSImgDirectionRef and GPSDestBearingRef
'exif-gpsdirection-t' => 'Tegelik suund',
'exif-gpsdirection-m' => 'Magneetiline suund',

# External editor support
'edit-externally'      => 'Töötle faili välise programmiga',
'edit-externally-help' => '(Vaata väliste redaktorite [http://www.mediawiki.org/wiki/Manual:External_editors kasutusjuhendit])',

# 'all' in various places, this might be different for inflected languages
'recentchangesall' => 'kõik',
'imagelistall'     => 'kõik pildid',
'watchlistall2'    => 'Näita kõiki',
'namespacesall'    => 'kõik',
'monthsall'        => 'kõik',

# E-mail address confirmation
'confirmemail'             => 'Kinnita e-posti aadress',
'confirmemail_noemail'     => 'Sul ei ole e-aadress määratud [[Special:Preferences|eelistustes]].',
'confirmemail_text'        => 'Enne kui saad e-postiga seotud teenuseid kasutada, pead sa oma e-posti aadressi õigsust kinnitama. Allpool olevale nupule klikkides meilitakse sulle kinnituskood, koodi kinnitamiseks kliki meilis oleval lingil.',
'confirmemail_send'        => 'Meili kinnituskood',
'confirmemail_sent'        => 'Kinnitusmeil saadetud.',
'confirmemail_oncreate'    => 'Kinnituskood saadeti su meiliaadressile. See kood ei ole vajalik sisselogimisel, kuid seda on vaja, et kasutada vikis e-posti-põhiseid toiminguid.',
'confirmemail_sendfailed'  => 'Kinnitusmeili ei õnnestunud saata. 
Kontrolli aadressi õigsust.

Veateade meili saatmisel: $1',
'confirmemail_invalid'     => 'Vigane kinnituskood, kinnituskood võib olla aegunud.',
'confirmemail_needlogin'   => 'Oma e-posti aadressi kinnitamiseks pead sa $1.',
'confirmemail_success'     => 'Sinu e-posti aadress on nüüd kinnitatud. Sa võid sisse logida ning viki imelisest maailma nautida.',
'confirmemail_loggedin'    => 'Sinu e-posti aadress on nüüd kinnitatud.',
'confirmemail_error'       => 'Viga kinnituskoodi salvestamisel.',
'confirmemail_subject'     => '{{SITENAME}}: e-posti aadressi kinnitamine',
'confirmemail_body'        => 'Keegi, ilmselt sa ise, registreeris IP aadressilt $1 saidil {{SITENAME}} kasutajakonto "$2".

Kinnitamaks, et see kasutajakonto tõepoolest kuulub sulle ning aktiveerimaks e-posti teenuseid, ava oma brauseris järgnev link:

$3

Kui see *ei* ole sinu loodud konto, siis ava järgnev link $5 kinnituse tühistamiseks. 

Kinnituskood aegub $4.',
'confirmemail_invalidated' => 'E-aadressi kinnitamine tühistati',
'invalidateemail'          => 'Tühista e-posti kinnitus',

# Scary transclusion
'scarytranscludetoolong' => '[URL on liiga pikk]',

# Delete conflict
'deletedwhileediting' => 'Hoiatus: Sel ajal, kui sina artiklit redigeerisid, kustutas keegi selle ära!',
'confirmrecreate'     => "Kasutaja [[User:$1|$1]] ([[User talk:$1|arutelu]]) kustutas lehekülje sellel ajal, kui sina seda redigeerisid. Põhjus:
: ''$2''
Palun kinnita, et soovid tõesti selle lehekülje taasluua.",
'recreate'            => 'Taasta',

# HTML dump
'redirectingto' => 'Ümbersuunamine lehele [[:$1]]...',

# action=purge
'confirm_purge'        => 'Puhasta selle lehekülje vahemälu?

$1',
'confirm_purge_button' => 'Sobib',

# AJAX search
'searchcontaining' => "Otsi lehekülgi, mille osa on ''$1''.",
'searchnamed'      => "Otsi lehekülgi, mille nimi on ''$1''.",
'hideresults'      => 'Peida tulemused',
'useajaxsearch'    => 'Kasuta AJAX-otsingut',

# Multipage image navigation
'imgmultipageprev' => '← eelmine lehekülg',
'imgmultipagenext' => 'järgmine lehekülg →',
'imgmultigo'       => 'Mine!',
'imgmultigoto'     => 'Mine leheküljele $1',

# Table pager
'ascending_abbrev'         => 'tõusev',
'descending_abbrev'        => 'laskuv',
'table_pager_next'         => 'Järgmine lehekülg',
'table_pager_prev'         => 'Eelmine lehekülg',
'table_pager_first'        => 'Esimene lehekülg',
'table_pager_last'         => 'Viimane lehekülg',
'table_pager_limit'        => 'Näita lehekülje kohta $1 üksust',
'table_pager_limit_submit' => 'Mine',
'table_pager_empty'        => 'Ei ole tulemusi',

# Auto-summaries
'autosumm-blank'   => 'Kustutatud kogu lehekülje sisu',
'autosumm-replace' => "Lehekülg asendatud tekstiga '$1'",
'autoredircomment' => 'Ümbersuunamine lehele [[$1]]',
'autosumm-new'     => "Uus lehekülg: '$1'",

# Live preview
'livepreview-loading' => 'Laen...',
'livepreview-ready'   => 'Laadimisel... Valmis!',
'livepreview-failed'  => 'Elav eelvaade ebaõnnestus! Proovi normaalset eelvaadet.',
'livepreview-error'   => 'Ühendus ebaõnnestus: $1 "$2".
Proovi tavalist eelvaadet.',

# Friendlier slave lag warnings
'lag-warn-normal' => 'Viimase {{PLURAL:$1|ühe sekundi|$1 sekundi}} jooksul tehtud muudatused ei pruugi selles loendis näha olla.',
'lag-warn-high'   => 'Andmebaasiserveri töö viivituste tõttu ei pruugi viimase {{PLURAL:$1|ühe sekundi|$1 sekundi}} jooksul tehtud muudatused selles loendis näha olla.',

# Watchlist editor
'watchlistedit-numitems'       => 'Teie jälgimisloendis on ilma arutelulehtedeta {{PLURAL:$1|1 leht|$1 lehte}}.',
'watchlistedit-noitems'        => 'Teie jälgimisloend ei sisalda ühtegi lehekülge.',
'watchlistedit-normal-title'   => 'Jälgimisloendi redigeerimine',
'watchlistedit-normal-legend'  => 'Jälgimisloendist lehtede eemaldamine',
'watchlistedit-normal-explain' => "Need lehed on teie jälgimisloendis.
Et lehti jälgimisloendist eemaldada, tehke vastava lehe ees olevasse kastikesse linnuke ja vajutage siis nuppu '''Eemalda valitud lehed'''. Kuid teil on võimalus muuta siit ka [[Special:Watchlist/raw|jälgimisloendi algandmeid]].",
'watchlistedit-normal-submit'  => 'Eemalda valitud lehed',
'watchlistedit-normal-done'    => 'Teie jälgimisloendist eemaldati {{PLURAL:$1|1 leht|$1 lehte}}:',
'watchlistedit-raw-title'      => 'Jälgimisloendi algandmed',
'watchlistedit-raw-legend'     => 'Redigeeritavad jälgimisloendi algandmed',
'watchlistedit-raw-explain'    => 'Sinu jälgimisloendi pealkirjad on kuvatud all asuvas tekstikastis, kus sa saad neid lisada ja/või eemaldada;
Iga pealkiri asub ise real.
Kui sa oled lõpetanud, vajuta all nuppu Uuenda jälgimisloendit.
Aga samuti võid sa [[Special:Watchlist/edit|kasutada harilikku redaktorit]].',
'watchlistedit-raw-titles'     => 'Pealkirjad:',
'watchlistedit-raw-submit'     => 'Uuenda jälgimisloendit',
'watchlistedit-raw-done'       => 'Teie jälgimisloend on uuendatud.',
'watchlistedit-raw-added'      => '{{PLURAL:$1|1 lehekülg|$1 lehekülge}} lisatud:',
'watchlistedit-raw-removed'    => '{{PLURAL:$1|1 pealkiri|$1 pealkirja}} eemaldati:',

# Watchlist editing tools
'watchlisttools-view' => 'Näita vastavaid muudatusi',
'watchlisttools-edit' => 'Vaata ja redigeeri jälgimisloendit',
'watchlisttools-raw'  => 'Muuda lähteteksti',

# Special:Version
'version'                       => 'Versioon', # Not used as normal message but as header for the special page itself
'version-extensions'            => 'Paigaldatud lisad',
'version-specialpages'          => 'Erileheküljed',
'version-parserhooks'           => 'Süntaksianalüsaatori lisad (Parser hooks)',
'version-variables'             => 'Muutujad',
'version-other'                 => 'Muu',
'version-mediahandlers'         => 'Meediatöötlejad',
'version-hooks'                 => 'Redaktsioon',
'version-extension-functions'   => 'Lisafunktsioonid',
'version-parser-extensiontags'  => 'Parseri lisamärgendid',
'version-parser-function-hooks' => 'Parserifunktsioonid',
'version-hook-name'             => 'Redaktsiooni nimi',
'version-hook-subscribedby'     => 'Tellijad',
'version-version'               => 'Versioon',
'version-license'               => 'Litsents',
'version-software'              => 'Paigaldatud tarkvara',
'version-software-product'      => 'Toode',
'version-software-version'      => 'Versioon',

# Special:FilePath
'filepath'        => 'Failitee',
'filepath-page'   => 'Fail:',
'filepath-submit' => 'Tee',

# Special:FileDuplicateSearch
'fileduplicatesearch'          => 'Otsi faili duplikaate',
'fileduplicatesearch-legend'   => 'Otsi faili duplikaati',
'fileduplicatesearch-filename' => 'Faili nimi:',
'fileduplicatesearch-submit'   => 'Otsi',
'fileduplicatesearch-info'     => '$1 × $2 pikslit<br />Faili suurus: $3<br />MIME-tüüp: $4',
'fileduplicatesearch-result-1' => 'Failil "$1" ei ole identset duplikaati.',
'fileduplicatesearch-result-n' => 'Failil "$1" on {{PLURAL:$2|1 samane duplikaat|$2 samast duplikaati}}.',

# Special:SpecialPages
'specialpages'                   => 'Erileheküljed',
'specialpages-note'              => '----
* Harilikud erileheküljed
* <strong class="mw-specialpagerestricted">Piiranguga erileheküljed.</strong>',
'specialpages-group-maintenance' => 'Hooldusraportid',
'specialpages-group-other'       => 'Teised erileheküljed',
'specialpages-group-login'       => 'Sisselogimine / registreerumine',
'specialpages-group-changes'     => 'Viimased muudatused ja logid',
'specialpages-group-media'       => 'Failidega seonduv',
'specialpages-group-users'       => 'Kasutajad ja õigused',
'specialpages-group-highuse'     => 'Tihti kasutatud leheküljed',
'specialpages-group-pages'       => 'Lehekülgede loendid',
'specialpages-group-pagetools'   => 'Töö lehekülgedega',
'specialpages-group-wiki'        => 'Viki andmed ja tööriistad',
'specialpages-group-redirects'   => 'Ümbersuunavad erilehed',
'specialpages-group-spam'        => 'Töö spämmiga',

# Special:BlankPage
'blankpage'              => 'Tühi leht',
'intentionallyblankpage' => 'See lehekülg on sihilikult tühjaks jäetud.',

);
