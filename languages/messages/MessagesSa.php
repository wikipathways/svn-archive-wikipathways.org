<?php
/** Sanskrit (संस्कृत)
 *
 * See MessagesQqq.php for message documentation incl. usage of parameters
 * To improve a translation please visit http://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 * @author Hemant wikikosh1
 * @author Kaustubh
 * @author Mahitgar
 * @author Naveen Sankar
 * @author Omnipaedista
 * @author రాకేశ్వర
 */

$fallback = 'hi';

$digitTransformTable = array(
	'0' => '०', # &#x0966;
	'1' => '१', # &#x0967;
	'2' => '२', # &#x0968;
	'3' => '३', # &#x0969;
	'4' => '४', # &#x096a;
	'5' => '५', # &#x096b;
	'6' => '६', # &#x096c;
	'7' => '७', # &#x096d;
	'8' => '८', # &#x096e;
	'9' => '९', # &#x096f;
);

$linkPrefixExtension = false;

$namespaceNames = array(
	NS_MEDIA            => 'Media',
	NS_SPECIAL          => 'Special',
	NS_MAIN	            => '',
	NS_TALK	            => 'संभाषणं',
	NS_USER             => 'योजकः',
	NS_USER_TALK        => 'योजकसंभाषणं',
	# NS_PROJECT set by $wgMetaNamespace
	NS_PROJECT_TALK     => '$1संभाषणं',
	NS_FILE             => 'चित्रं',
	NS_FILE_TALK        => 'चित्रसंभाषणं',
	NS_MEDIAWIKI        => 'MediaWiki',
	NS_MEDIAWIKI_TALK   => 'MediaWiki_talk',
	NS_TEMPLATE         => 'Template',
	NS_TEMPLATE_TALK    => 'Template_talk',
	NS_HELP             => 'उपकारः',
	NS_HELP_TALK        => 'उपकारसंभाषणं',
	NS_CATEGORY         => 'वर्गः',
	NS_CATEGORY_TALK    => 'वर्गसंभाषणं',
);

$messages = array(
# User preference toggles
'tog-underline'               => 'संबंधनानि अधोरेखितानि करोतु',
'tog-highlightbroken'         => 'भग्नानि संबंधनानि <a href="" class="new"> एवं दर्शयतु </a> (अथवा : एवं दर्शयतु <a href="" class="internal">?</a>)।',
'tog-justify'                 => 'परिच्छेदान् समानान् करोतु।',
'tog-hideminor'               => 'सद्यःभूतेभ्यः परिवर्तनेभ्यः लघूनि संपादनानि मा दर्शयतु।',
'tog-extendwatchlist'         => 'निरीक्षासूचिकां विस्तारयित्वा सर्वाणि परिवर्तनानि दर्शयतु, न तु केवलानि सद्यःभूतानि।',
'tog-usenewrc'                => 'संवृद्धानि (एन्-हेन्स्ड् इति) सद्यःभूतानि परिवर्तनानि प्रयोजयतु (जावास्क्रिप्टम् आवश्यकम्)।',
'tog-numberheadings'          => 'शीर्षकान् स्वयमेव सक्रमांकीकरोतु।',
'tog-showtoolbar'             => 'संपादन-उपकरण-पट्टिकां दर्शयतु (जावास्क्रिप्टम् आवश्यकम्)।',
'tog-editondblclick'          => 'द्विक्लिक्कारेण पृष्ठाणि संपादयतु (जावास्क्रिप्टम् आवश्यकम्)',
'tog-editsection'             => '[संपादयतु़] इति संबंधनद्वारा विभाग-संपादनं समर्थयतु।',
'tog-editsectiononrightclick' => 'विभाग-शीर्षकाणामुपरि दक्षिणक्लिक्कारेण विभागसंपादनं समर्थयतु (जावास्क्रिप्टम् आवश्यकम्)।',
'tog-showtoc'                 => 'अनुक्रमणिकां दर्शयतु (त्र्यधिकशीर्षकयुतेषु पृष्ठेषु)।',
'tog-rememberpassword'        => 'अस्मिन् संगणके मम संप्रवेशः (लॉगिन् इति) स्मृतीभवेत्।',
'tog-editwidth'               => 'संपादन-कोष्ठकं पटलव्यापिरूपेण दर्शयतु।',
'tog-watchcreations'          => 'मया रचितानि पृष्ठाणि मम निरीक्षासूचिकायां योजयतु।',
'tog-watchdefault'            => 'मया संपादितानि पृष्ठाणि मम निरीक्षासूचिकायां योजयतु।',
'tog-watchmoves'              => 'मया चालितानि पृष्ठाणि मम निरीक्षासूचिकायां योजयतु।',
'tog-watchdeletion'           => 'मया अपाकृतानि पृष्ठाणि मम निरीक्षासूचिकायां योजयतु।',
'tog-minordefault'            => 'मम सर्वाणि संपादनानि लघुत्वेन वर्तन्ते।',
'tog-previewontop'            => 'सम्पादन-पिटकस्योपरि प्राग्दृश्यं दर्शयतु।',
'tog-previewonfirst'          => 'प्रथम-संपादन-पश्चात् प्राग्दृश्यं दर्शयतु।',
'tog-nocache'                 => 'पृष्ठाणि उपस्मृतौ (कैश्-इत्यस्मिन्) मा धारयतु।',
'tog-enotifwatchlistpages'    => 'मम निरीक्षासूचिकायां सतां पृष्ठाणां परिवर्तनसमये मां विद्युत्पत्रेण (ईमेल् इति) ज्ञापयतु।',
'tog-enotifusertalkpages'     => 'मम योजकसंभाषणपृष्ठे परिवर्तिते सति मां विद्युत्पत्रेण (ईमेल् इति) ज्ञापयतु।',
'tog-enotifminoredits'        => 'लघुपरिवर्तनेषु सत्सु अपि मां विद्युत्पत्रेण (ईमेल् इति) ज्ञापयतु।',
'tog-enotifrevealaddr'        => 'अधिसूचना-विद्युत्पत्रेषु मम विद्युत्पत्रसंकेतं दर्शयतु।',
'tog-shownumberswatching'     => 'निरीक्षमतां प्रयोक्तृणां संख्यां दर्शयतु।',
'tog-fancysig'                => 'हस्ताक्षराणि विकिपाठवत् सन्तु (स्वचालित-संबंधनेभ्यः रहितानि)।',
'tog-externaleditor'          => 'अकथिते (बाइ डिफाल्ट् इति), बाह्य संपादकं प्रयोजयतु (केवलेभ्यः निपुणेभ्यः, भवतः संगणके विशेषाः न्यासाः (सेटिंग्स् इति) आवश्यकाः)।',
'tog-externaldiff'            => 'अकथिते (बाइ डिफाल्ट् इति), बाह्य अंतरक्रमादेशं प्रयोजयतु (केवलेभ्यः निपुणेभ्यः, भवतः संगणके विशेषाः न्यासाः आवश्यकाः)।',
'tog-showjumplinks'           => '"इत्येतत् प्रति कूर्दयतु" इति संबंधनानि समर्थयतु।',
'tog-uselivepreview'          => 'संपादनेन सहैव प्राग्दृश्यं दर्शयतु (जावास्क्रिप्टम् आवश्यकम्) (प्रयोगात्मकम्)।',
'tog-forceeditsummary'        => 'संपादन-सारांशः चेत् न ददामि तदा मां ज्ञापयतु।',
'tog-watchlisthideown'        => 'मम संपादनानि निरीक्षासूचिकातः लोपयतु।',
'tog-watchlisthidebots'       => 'बोट्कृतानि संपादनानि निरीक्षासूचिकातः लोपयतु।',
'tog-watchlisthideminor'      => 'मम निरीक्षासूचिकातः लघूनि संपादनानि लोपयतु।',
'tog-watchlisthideliu'        => 'प्रवेशितेभ्यः प्रयोक्तृभ्यः कृतानि संपादनानि मम निरीक्षासूचिकातः लोपयतु।',
'tog-watchlisthideanons'      => 'अनामकेभ्यः प्रयोक्तृभ्यः कृतानि संपादनानि मम निरीक्षासूचिकातः लोपयतु।',
'tog-ccmeonemails'            => 'मया अन्यान् प्रति प्रेषितानां विद्युत्पत्राणां प्रतिलिप्यः मां प्रेषयतु।',
'tog-diffonly'                => 'आवृत्तिसु अंतरं दर्शयन् पुरातनाः आवृत्तयः मा दर्शयतु।',
'tog-showhiddencats'          => 'लोपिताः श्रेण्यः दर्शयतु।',
'tog-norollbackdiff'          => 'पूर्णप्रतिगमने कृते मा दर्शयतु तद् अंतरम्।',

'underline-always'  => 'सदा',
'underline-never'   => 'नैव',
'underline-default' => 'ब्राउसर अकथितप्रकरणम्।',

# Dates
'sunday'        => 'रविवासरः',
'monday'        => 'सोमवासरः',
'tuesday'       => 'मंगळवासरः',
'wednesday'     => 'बुधवासरः',
'thursday'      => 'गुरुवासरः',
'friday'        => 'शुक्रवासरः',
'saturday'      => 'शनिवासरः',
'sun'           => 'रविः',
'mon'           => 'सोमः',
'tue'           => 'मंगळः',
'wed'           => 'बुधः',
'thu'           => 'गुरुः',
'fri'           => 'शुक्रः',
'sat'           => 'शनिः',
'january'       => 'जनवरीमासः',
'february'      => 'फेब्रुवरीमासः',
'march'         => 'मार्चमासस्य',
'april'         => 'एप्रिलमासः',
'may_long'      => 'मेमासः',
'june'          => 'जूनमासः',
'july'          => 'जुलाइमासः',
'august'        => 'आगस्टमासः',
'september'     => 'सेप्टेम्बरमासः',
'october'       => 'अक्टूबरमासः',
'november'      => 'नवम्बरमासः',
'december'      => 'डेसेम्बरमासः',
'january-gen'   => 'जनवरीमासस्य',
'february-gen'  => 'फेब्रुवरीमासस्य',
'march-gen'     => 'मार्चमासस्य',
'april-gen'     => 'एप्रिलमासस्य',
'may-gen'       => 'मेमासस्य',
'june-gen'      => 'जूनमासस्य',
'july-gen'      => 'जुलाइमासस्य',
'august-gen'    => 'आगस्टमासस्य',
'september-gen' => 'सेप्टेंबरमासस्य',
'october-gen'   => 'अक्टूबरमासस्य',
'november-gen'  => 'नवंबरमासस्य',
'december-gen'  => 'डेसेंबरमासस्य',
'jan'           => 'जन.',
'feb'           => 'फेब्रु.',
'mar'           => 'मार्च.',
'apr'           => 'एप्रि.',
'may'           => 'मे.',
'jun'           => 'जून.',
'jul'           => 'जुला.',
'aug'           => 'अग.',
'sep'           => 'सित.',
'oct'           => 'अक्टू.',
'nov'           => 'नव.',
'dec'           => 'दिस.',

# Categories related messages
'pagecategories'                 => '{{PLURAL:$1|श्रेणी|श्रेण्यः }}',
'category_header'                => '"$1" इति श्रेण्यां पृष्ठाणि',
'subcategories'                  => 'उपश्रेण्यः',
'category-media-header'          => '"$1" इति श्रेण्यां माध्यमानि (मीडिया इति)।',
'category-empty'                 => "''अस्मिन् श्रेण्यां संप्रति न कोऽपि पृष्ठं, माध्यमं वा विद्यते।''",
'hidden-categories'              => '{{PLURAL:$1|लोपिता श्रेणी|लोपिताः श्रेण्यः}}',
'hidden-category-category'       => 'लोपिताः श्रेण्यः', # Name of the category where hidden categories will be listed
'category-subcat-count'          => '{{PLURAL:$2|अस्मन् श्रेण्यां केवला अधोलिखिता उपश्रेणी विद्यते|अस्मिन् श्रेण्यां {{PLURAL:$1|अधोलिखिता उपश्रेणी अस्ति|अधोलिखिताः $1 उपश्रेण्यः सन्ति}}, सकलाः उपश्रेण्यः $2 ।}}',
'category-subcat-count-limited'  => 'अस्मिन् श्रेण्यां {{PLURAL:$1|अधोलिखिता $1 उपश्रेणी अस्ति|अधोलिखितानि $1 उपश्रेण्यः सन्ति}}।',
'category-article-count'         => '{{PLURAL:$2|अस्मिन् श्रेण्यां केवलं इदं पृष्ठं विद्यते ।|अस्मिन् श्रेण्यां  {{PLURAL:$1|अधोलिखितं पृष्ठमस्ति|$1 अधोलिखितानि पृष्ठाणि सन्ति}}, सकलानि पृष्ठाणि $2 ।}}',
'category-article-count-limited' => 'अधोलिखितं {{PLURAL:$1|पृष्ठम् अस्मिन् श्रेण्याम् अस्ति|$1 पृष्ठाणि अस्मिन् श्रेण्यां सन्ति}}।',
'category-file-count'            => '{{PLURAL:$2|अस्मिन् श्रेण्यां केवला अधोलिखिता संचिका वर्तते।|अस्मिन् श्रेण्यां  {{PLURAL:$1|अधोलिखिता संचिका|अधोलिखिताः $1 संचिकाः}} वर्तन्ते, सकलाः संचिकाः - $2 ।}}',
'listingcontinuesabbrev'         => 'आगामि.',

'about'          => 'विषयः:',
'article'        => 'लेखनम्',
'newwindow'      => '(नवे गवाक्षे उद्घाट्यते)',
'cancel'         => 'निरसनम्',
'qbfind'         => 'अन्वेषयतु',
'qbbrowse'       => 'ब्राउस् इत्येतत् करोतु।',
'qbedit'         => 'संपादयतु',
'qbpageoptions'  => 'इदं पृष्ठम्',
'qbpageinfo'     => 'प्रसंगः',
'qbmyoptions'    => 'मम पृष्ठाणि',
'qbspecialpages' => 'विशिष्टपृष्ठाणि',
'moredotdotdot'  => 'अपि च...',
'mypage'         => 'मम पृष्ठम्',
'mytalk'         => 'मम संभाषणम्',
'anontalk'       => 'अस्य आइ.पी. संकेतस्य कृते संभाषणम्',
'navigation'     => 'सुचलनम्',
'and'            => '&#32;तथा च',

# Metadata in edit box
'metadata_help' => 'अधिदत्तम् (मेटाडाटा):',

'errorpagetitle'    => 'विभ्रमः',
'returnto'          => '$1 इत्येतद् प्रति निवर्तताम्।',
'tagline'           => '{{SITENAME}} इत्यस्मात्',
'help'              => 'सहायम्',
'search'            => 'अन्वेषणम्',
'searchbutton'      => 'अन्विष्यतु',
'go'                => 'गच्छतु',
'searcharticle'     => 'गच्छतु',
'history'           => 'पृष्ठस्य इतिहासः',
'history_short'     => 'इतिहासः',
'updatedmarker'     => 'मम पौर्विक-आगमन-पश्चात् परिवर्तितानि',
'info_short'        => 'समाचारः',
'printableversion'  => 'मुद्रणीय पाठान्तरम्',
'permalink'         => 'स्थिरबन्धनम्',
'print'             => 'मुद्रयतु',
'edit'              => 'संपादयतु',
'create'            => 'सृजतु',
'editthispage'      => 'इदं पृष्ठं सम्पादयतु',
'create-this-page'  => 'इदं पृष्ठं सृज',
'delete'            => 'विनाशयतु',
'deletethispage'    => 'एतत् पृष्ठं अपाकरोतु',
'undelete_short'    => '{{PLURAL:$1|एकं सम्पादनं|$1 सम्पादनानि}} अनपाकरोतु',
'protect'           => 'सुरक्षित करोसि',
'protect_change'    => 'परिवर्तयतु',
'protectthispage'   => 'एतत्पृष्ठं सुरक्षितीकरोतु।',
'unprotect'         => 'असुरक्षितीकरोतु',
'unprotectthispage' => 'एतत्पृष्ठं असुरक्षितीकरोतु',
'newpage'           => 'नवीनपृष्ठम्',
'talkpage'          => 'अस्य पृष्ठस्य विषये चर्चां करोतु',
'talkpagelinktext'  => 'संभाषणम्',
'specialpage'       => 'विशेषपृष्ठम्',
'personaltools'     => 'वैयक्तिक उपकरणानि',
'postcomment'       => 'नवीन विभागः',
'articlepage'       => 'लेखनं पश्यतु',
'talk'              => 'चर्चा',
'views'             => 'दृश्यरूपाणि',
'toolbox'           => 'उपकरणपेटिका',
'userpage'          => 'प्रयोक्तृ-पृष्ठं पश्यतु',
'projectpage'       => 'प्रकल्प-पृष्ठं पश्यतु',
'imagepage'         => 'सञ्चिका-पृष्ठं पश्यतु',
'mediawikipage'     => 'सन्देश-पृष्ठं पश्यतु।',
'templatepage'      => 'संफलकपृष्ठं पश्यतु',
'viewhelppage'      => 'सहायपृष्ठं पश्यतु',
'categorypage'      => 'श्रेणी-पृष्ठं पश्यतु',
'viewtalkpage'      => 'चर्चां पश्यतु',
'otherlanguages'    => 'अन्यासु भाषासु',
'redirectedfrom'    => '($1 इत्यस्मात् अनुप्रेषितम्)',
'redirectpagesub'   => 'अनुप्रेषण-पृष्ठम्',
'lastmodifiedat'    => 'एतत् पृष्ठस्य अन्तिमपरिवर्तनं $1 दिवसे $2 वादने कृतम्', # $1 date, $2 time
'viewcount'         => 'एतत्पृष्ठं {{PLURAL:$1|एक वारं|$1 वारं}} दृष्टम् अस्ति',
'protectedpage'     => 'संरक्षितपृष्ठम्',
'jumpto'            => 'कूर्दयतु अत्र :',
'jumptonavigation'  => 'सुचलनम्',
'jumptosearch'      => 'अन्वेषणम्',

# All link text and link target definitions of links into project namespace that get used by other message strings, with the exception of user group pages (see grouppage) and the disambiguation template definition (see disambiguations).
'aboutsite'            => '{{SITENAME}} इत्यस्य विषये',
'aboutpage'            => 'Project:विवरणम्',
'copyright'            => 'अस्य घटकानि $1 इत्यस्यान्तर्गतानि उपलब्धानि।',
'copyrightpage'        => '{{ns:project}}:प्रतिलिप्यधिकाराणि',
'currentevents'        => 'सद्य घटना',
'currentevents-url'    => 'Project:सद्यस्काः घटनाः',
'disclaimers'          => 'प्रत्याख्यानम्',
'disclaimerpage'       => 'Project:सामान्यं प्रत्याख्यानम्',
'edithelp'             => 'संपादनार्थं सहायम्',
'edithelppage'         => 'Help:संपादनम्',
'faq'                  => 'बहुधा पृष्टव्याः प्रश्नाः',
'faqpage'              => 'Project:बहुधा पृष्टव्याः प्रश्नाः',
'helppage'             => 'Help:घटकानि',
'mainpage'             => 'मुख्यपृष्ठम्',
'mainpage-description' => 'मुख्यपृष्ठम्',
'policy-url'           => 'Project:नीतिः',
'portal'               => 'समुदाय द्वारकम्',
'portal-url'           => 'Project:समुदाय द्वारकम्',
'privacy'              => 'नैजता-नीतिः',
'privacypage'          => 'Project:नैजता-नीतिः',

'badaccess' => 'अनुज्ञा-विभ्रमः',

'ok'                  => 'आम्',
'pagetitle'           => '',
'retrievedfrom'       => '"$1" इत्यस्मात् गृहीतम्',
'youhavenewmessages'  => 'भवदर्थम् $1 सन्ति। ($2).',
'newmessageslink'     => 'नूतनाः संदेशाः',
'newmessagesdifflink' => 'अन्तिमपरिवर्तनम्',
'editsection'         => 'संपादयतु',
'editold'             => 'संपादनम्',
'viewsourceold'       => 'स्रोतः पश्यतु',
'editlink'            => 'संपादयतु',
'viewsourcelink'      => 'स्रोतसम् दर्शयतु',
'editsectionhint'     => 'विभागं संपादयतु: $1',
'toc'                 => 'अन्तर्विषयाः',
'showtoc'             => 'दर्शयतु',
'hidetoc'             => 'गोपयतु',
'feedlinks'           => 'अनुबन्ध:',
'site-rss-feed'       => '$1 आरएसएस पूरणम्',
'site-atom-feed'      => '$1 ऍटम पूरणम्',
'page-rss-feed'       => '"$1" आरएसएस-पूरणम्',
'page-atom-feed'      => '"$1" ऍटम अनुबन्ध',
'red-link-title'      => '$1 (पृष्ठं इदानीं यावत् न रचितम्)',

# Short words for each namespace, by default used in the namespace tab in monobook
'nstab-main'      => 'पृष्ठम्',
'nstab-user'      => 'प्रयोक्तृपृष्ठम्',
'nstab-media'     => 'माध्यमपृष्ठम्',
'nstab-special'   => 'विशिष्टपृष्ठम्',
'nstab-project'   => 'प्रकल्पपृष्ठम्',
'nstab-image'     => 'सञ्चिका',
'nstab-mediawiki' => 'सन्देशः',
'nstab-template'  => 'संफलकम्',
'nstab-help'      => 'सहायपृष्ठम्',
'nstab-category'  => 'श्रेणी',

# Main script and global functions
'nosuchaction' => 'तथाविध न कर्म',

# General errors
'error'               => 'विभ्रम',
'databaseerror'       => 'दत्ताधार-विभ्रमः',
'missing-article'     => 'दत्ताधारेण(डाटाबेस् इत्यनेन) "$1" $2 इतिनामकं पृष्ठं नैव प्राप्तम्, यत्तु प्राप्तीभवितव्यमासीत्।

कदाचित् एवं तु अवसिते सति अंतरे अथवा अपाकृतस्य पृष्ठस्य इतिहास-संबंधनात् भवति।


यदि न एवं विद्यते, तदा भवता क्रमादेश-कीटकं अन्विष्टम्।
कृपया केनचित् [[Special:ListUsers/sysop|प्रचालकेन]] सह अस्य पृष्ठस्य URL इत्येतद्- ज्ञापनपूर्वकं संभाषताम्।',
'missingarticle-rev'  => '(आवृत्तिः# :$1)',
'missingarticle-diff' => '(व्यतिरेक: $1, $2)',
'badtitletext'        => 'प्रार्थितं पृष्ठ-शीर्षकं अमान्यं वा, रिक्तं वा, अथवा अशुद्धतया संबंद्धं आंतर्भाषिकं, आंतर्विकीयं वा शीर्षकमस्ति। अस्मिन् एकं एकाधिकानि वा एतादृशाणि अक्षराणि विद्यन्ते येषां प्रयोगं शीर्षकेषु अशक्यम्।',
'viewsource'          => 'स्रोतः दर्शयतु',
'viewsourcefor'       => '$1 कृते',

# Login and logout pages
'welcomecreation'         => '<h2>स्वागतम्‌, $1!</h2><p>भवतः/भवत्याः लेखा सृष्टाऽस्ति।
भवान्/भवती स्वकीयानि {{SITENAME}} वरीयांसि (प्रिफ़रेन्सेस्)  स्वच्छानुसारं कर्तुं शक्नोति।',
'yourname'                => 'प्रयोक्तृ-नाम :',
'yourpassword'            => 'रहस्यवाक् :',
'yourpasswordagain'       => 'रहस्यवाक् पुनः लिखतु।',
'remembermypassword'      => 'अस्मिन् संगणके मम प्रवेशसंबंधि-सूचनाः स्मरतु',
'login'                   => 'प्रविशतु',
'nav-login-createaccount' => 'प्रविशतु / लेखां सृजतु',
'userlogin'               => 'प्रविशतु / लेखां सृजतु',
'logout'                  => 'बहिर्गच्छतु',
'userlogout'              => 'बहिर्गच्छति',
'nologinlink'             => 'लेखां रचयतु',
'createaccount'           => 'लेखां रचयतु',
'gotaccountlink'          => 'प्रविशतु',
'yourlanguage'            => 'भाषा:',
'email'                   => 'विद्युत्पत्रव्यवस्था',
'loginsuccesstitle'       => 'सुस्वागतम्‌। प्रवेशः सिद्धः।',
'mailmypassword'          => 'नूतनं रहस्यवाक् विद्युत्पत्रेण प्रेषयतु',
'loginlanguagelabel'      => 'भाषा : $1',

# Password reset dialog
'resetpass_text'            => '<!-- पाठं अत्र लिखतु -->',
'oldpassword'               => 'पुरातन रहस्यवाक् :',
'newpassword'               => 'नूतन रहस्यवाक् :',
'retypenew'                 => 'नूतन रहस्यवाक् पुनर्लिखतु :',
'resetpass-submit-loggedin' => 'रहस्यवाक् परिवर्तयतु',
'resetpass-temp-password'   => 'अस्थिर रहस्यवाक् :',

# Edit page toolbar
'bold_sample'     => 'स्थूलाक्षरितपाठः',
'bold_tip'        => 'स्थूलाक्षरम्',
'italic_sample'   => 'तिर्यक् अक्षरम्',
'italic_tip'      => 'तिर्यक् अक्षरम्',
'link_sample'     => 'संबंधनस्य शीर्षकम्',
'link_tip'        => 'अन्तर्गतं संबंधनम्',
'extlink_sample'  => 'http://www.example.com संबंधनस्य शीर्षकम्',
'extlink_tip'     => 'बाह्य-संबंधनम् (अवश्यमेव  http:// इति पूर्वलग्नं योक्तव्यम्)',
'headline_sample' => 'शीर्षकम्',
'headline_tip'    => 'द्वितीय-स्तरीयं शीर्षकम्',
'math_sample'     => 'सूत्रवाक्यं अत्र निवेशयतु',
'math_tip'        => 'गणितीयसूत्रम् (LaTeX)',
'nowiki_sample'   => 'अप्रारूपीकृतं पाठं अत्र निवेशयतु',
'nowiki_tip'      => 'विकिप्रारूपणं अवगणना कुरु',
'image_sample'    => 'उदाहरणम्.jpg',
'image_tip'       => 'अन्तर्गता संचिका',
'media_sample'    => 'उदाहरणम्.ogg',
'media_tip'       => 'संचिका-संबंधनम्',
'sig_tip'         => 'भवतः हस्ताक्षराणि समयेन सह',
'hr_tip'          => 'क्षैतिज-रेखा (न्यूनतया प्रयोक्तव्या)',

# Edit pages
'summary'                          => 'संग्रहः :',
'subject'                          => 'विषयः/शीर्षकम् :',
'minoredit'                        => 'इदं लघु परिवर्तनम्',
'watchthis'                        => 'एतत् पृष्ठं निरीक्षताम्',
'savearticle'                      => 'पृष्ठं रक्षतु',
'preview'                          => 'प्राग्दृश्यम्',
'showpreview'                      => 'प्राग्दृश्यं दर्शयतु',
'showdiff'                         => 'परिवर्तनानि दर्शयतु',
'anoneditwarning'                  => "'''सावधानो भवतु:''' भवता प्रवेशं न कृतम्। 
अस्य पृष्ठस्य इतिहासे भवतः आइ-पी-संकेतः अंकितः भविष्यति।",
'summary-preview'                  => 'सारांशस्य प्राग्दृश्यम् :',
'newarticle'                       => '(नवीनम्)',
'newarticletext'                   => "भवता एतादृशमेकं पृष्टं प्रति संबंधनम् अनुसृतम्, यत्पृष्ठं न इदानींयावत् विद्यते।

पृष्ठं स्रष्टुम् अधःप्रदत्तायां पेटिकायां टंकणं करोतु (सहाय्यार्थं [[{{MediaWiki:Helppage}}|अत्र]] क्लिक्करोतु।

चेद्भवान् अत्र भ्रान्तिना आनीतोऽस्ति तदा स्वकीये ब्राउसर् इत्यस्मिन् '''बैक्''' इत्यस्मिन् क्लिक्करोतु।)",
'noarticletext'                    => 'अस्मिन् पृष्ठे संप्रति न कोऽपि पाठः विद्यते। भवान् विकिपीडियावर्तिषु अन्येषु पृष्ठेषु इदं [[Special:Search/{{PAGENAME}}|शीर्षकम् अन्विष्टुं शक्नोति]] अथवा इदं पृष्ठं या फिर यह लेख [{{fullurl:{{FULLPAGENAME}}|action=edit}} स्रष्टुं शक्नोति]।',
'previewnote'                      => "'''स्मरणीयं यदेतत् केवलं प्राग्दृश्यमस्ति।'''
भवता कृतानि परिवर्तनानि इदानींयावत् न रक्षितानि सन्ति!",
'editing'                          => '$1 संपाद्यते',
'editingsection'                   => '$1 संपादनम् (विभागः)',
'copyrightwarning'                 => "कृपया संस्मर्तव्यं यत् {{SITENAME}} इत्येतद् प्रति कृतानि सर्वाणि योगदानानि $2 इत्यस्य प्रतिबंधांतर्गतानि सन्ति (अधिकाय ज्ञानाय $1 इत्येतद् पश्यतु)।

यदि भवान् स्वकीयानि लिखितानि परिवर्तमन्तश्च, पुनः वितर्यमन्तश्च न द्रष्टुमिच्छति तदा मा कृपया माऽत्र योगदानं करोतु। <br />

भवान् एतदपि प्रमाणीकरोति यत् एतद् भवता स्वतः लिखितमस्ति अथवा कस्माच्चत् जनार्पितात् वा मुक्तात् वा स्रोतसः प्रतिलिपीकृतमस्ति।

'''प्रतिलिप्यधिकारयुतान् लेखान्, अनुज्ञां विना, माऽत्र प्रददातु!'''",
'template-protected'               => '(संरक्षितम्)',
'template-semiprotected'           => '(अर्धसंरक्षितम्)',
'hiddencategories'                 => 'इदं पृष्ठं {{PLURAL:$1|1 निगूढस्य श्रेण्याः |$1 निगूढानां श्रेणीनां}} सदस्यत्वेन विद्यते :',
'permissionserrorstext-withaction' => 'भवान् $2 इत्येतदर्थम् अनुज्ञां न धारयति, अस्य कारणम्/कारणानि :',

# History pages
'viewpagelogs'           => 'अस्य पृष्ठस्य लॉंग् इत्येतद् दर्शयतु',
'previousrevision'       => '← पुरातनाः आवृत्तयः',
'nextrevision'           => 'नूतनतरा आवृत्तिः →',
'currentrevisionlink'    => 'सद्यःकालीना आवृत्तिः',
'cur'                    => 'नवतरम्',
'last'                   => 'पूर्वतनम्',
'page_first'             => 'प्रथमम्',
'page_last'              => 'अन्तिमम्',
'history-fieldset-title' => 'सुगमनस्य(ब्राउस् इत्यस्य) इतिहासः',
'histfirst'              => 'पुरातनतमम्',
'histlast'               => 'नूतनतमम्',

# Revision feed
'history-feed-item-nocomment' => '$1 उप $2', # user at time

# Revision deletion
'rev-delundel'   => 'दर्शयतु/गोपयतु',
'revdel-restore' => 'दृश्यतां परिवर्तयतु',

# Merge log
'revertmerge' => 'पृथक् करोतु',

# Diffs
'history-title'           => '"$1" इत्येतस्य आवर्तनेतिहासः :',
'difference'              => '(आवृत्तीनां मध्ये अन्तरम्)',
'lineno'                  => 'पंक्तिः $1:',
'compareselectedversions' => 'चितानां आवृत्तीनां परस्परं तुलनां करोतु',
'editundo'                => 'अकरोतु',

# Search results
'searchresults'             => 'अन्वेषण-फलानि',
'searchresults-title'       => '"$1" इत्यस्य कृते अन्वेषण-फलानि',
'searchresulttext'          => '{{SITENAME}} इत्यस्मिन् अन्वेषणे सहाय्यार्थम् [[{{MediaWiki:Helppage}}|{{int:help}}]] इत्येतत् पश्यतु ।',
'searchsubtitle'            => 'भवान् \'\'\'[[:$1]]\'\'\'([[Special:Prefixindex/$1|सर्वाणि "$1" इत्यस्माद् आरभमन्तः पृष्ठाणि]]{{int:pipe-separator}}[[Special:WhatLinksHere/$1|सर्वाणि "$1" इत्येतत्प्रति संबद्धानि पृष्ठाणि]]) इत्यस्य कृते अन्विष्टवान्।',
'searchsubtitleinvalid'     => "भवता '''$1''' इत्यस्य कृते अन्वेषणं कृतम्",
'noexactmatch'              => "'''\"\$1\" इति शीर्षकीयं न कोऽपि पृष्ठं विद्यते।'''
भवान् इदं पृष्ठं [[:\$1|स्रष्टुं शक्नोति]]।",
'noexactmatch-nocreate'     => "'''\"\$1\" इति शीर्षकीयं न कोऽपि पृष्ठं विद्यते।'''",
'notitlematches'            => 'न कस्यापि पृष्ठस्य शीर्षकम् अस्य समम्।',
'notextmatches'             => 'न कस्यापि पृष्ठस्य पाठः अस्य सममस्ति',
'nextn'                     => 'आगामि$1',
'viewprevnext'              => 'दर्शयतु ($1 {{int:pipe-separator}} $2) ($3)',
'search-result-size'        => '$1 ({{PLURAL:$2|1 शब्दम्|$2 शब्दे}})',
'search-redirect'           => '($1 इतीदं अनुप्रेषितम्)',
'search-section'            => '(विभागः $1)',
'search-suggest'            => 'किं भवतः आशयः एवमस्ति : $1',
'search-interwiki-caption'  => 'बन्धु-प्रकल्पाः',
'search-interwiki-default'  => '$1 परिणामाः :',
'search-interwiki-more'     => '(अधिकानि)',
'search-mwsuggest-enabled'  => 'उपक्षेपेभ्यः सह',
'search-mwsuggest-disabled' => 'नात्र उपक्षेपाः',
'showingresultstotal'       => "अधस्तात् {{PLURAL:$4| '''$1''' परिणामः '''$3''' इत्येभ्यः प्रदर्शितः|'''$1 - $2''' परिणामाः '''$3''' इत्येभ्यः प्रदर्शिताः}}",
'nonefound'                 => "'''सूचना''': स्वतः अत्र केषुचिदेव नामाकाशेषु अन्वेषणं क्रियते।

सकले घटके अन्वेषणं कर्तुं स्व अन्वेषणपदेभ्यः पूर्वं ''all:'' इति योजयतु, अथवा इष्टं नामाकाशं पूर्वलग्नरूपेण योजयतु।",
'powersearch'               => 'प्रगतम् अन्वेषणम्',
'powersearch-legend'        => 'प्रगतम् अन्वेषणम्',
'powersearch-ns'            => 'नामाकाशेषु अन्विष्यतु :',
'powersearch-redir'         => 'अनुप्रेषणानां सूचिकां दर्शयतु।',
'powersearch-field'         => 'इत्यस्मै अन्विष्यतु',

# Preferences page
'preferences'   => 'इष्टतमानि',
'mypreferences' => 'मम वरीयांसि',

# Groups
'group-sysop' => 'प्रबंधकाः',

'grouppage-sysop' => '{{ns:project}}:प्रचालकाः',

# User rights log
'rightslog' => 'प्रयोक्तृ-अधिकार-सूचिका',

# Associated actions - in the sentence "You do not have permission to X"
'action-edit' => 'इदं पृष्ठं संपादयतु',

# Recent changes
'nchanges'                       => '$1 {{PLURAL:$1|परिवर्तनम्|परिवर्तनानि}}',
'recentchanges'                  => 'नवतमानि परिवर्तनानि',
'recentchanges-legend'           => 'नवतमानां परिवर्तनानां विकल्पाः',
'recentchanges-feed-description' => 'अस्मिन् पूरणे विकि इत्यस्मिन् भूतानि नवतमानि परिवर्तनानि पश्यतु।',
'rcnote'                         => "अधस्तात् {{PLURAL:$1|'''1''' परिवर्तनमस्ति|अंतिमानि '''$1''' परिवर्तनानि सन्ति}},{{PLURAL:$2|गते दिवसे|'''$2''' गतेषु दिवसेषु}}, $5, $4 इति समये।",
'rclistfrom'                     => '$1 इत्यस्मात् आरभमन्तः नूतनानि परिवर्तनानि दर्शयतु',
'rcshowhideminor'                => '$1 लघूनि संपादनानि',
'rcshowhidebots'                 => '$1 बोट् इत्येतानि',
'rcshowhideliu'                  => '$1 प्रवेशिताः प्रयोक्तारः',
'rcshowhideanons'                => 'अनामकाः योजकाः $1',
'rcshowhidemine'                 => '$1 मम संपादनानि',
'rclinks'                        => 'अंतिमानि $1 परिवर्तनानि अंतिमेषु $2 दिनेषु, दर्शयतु<br />$3',
'diff'                           => 'अन्तरम्',
'hist'                           => 'इति.',
'hide'                           => 'गोपयतु',
'show'                           => 'दर्शयतु',
'minoreditletter'                => 'लघु',
'newpageletter'                  => 'न',
'boteditletter'                  => 'बो',
'rc-enhanced-expand'             => 'विवरणानि दर्शयतु (जावास्क्रिप्टम् आवश्यकम्)',
'rc-enhanced-hide'               => 'विवरणानि विलोपयतु',

# Recent changes linked
'recentchangeslinked'         => 'पृष्ठ-सम्बन्धि-परिवर्तनानि',
'recentchangeslinked-title'   => '"$1" इत्यस्मिन् भूतानि परिवर्तनानि',
'recentchangeslinked-summary' => "इदं पृष्ठं दर्शयति पृष्ठविशेषेण सह संबद्धीकृतेषु पृष्ठेषु परिवर्तनानि (अथवा श्रेणीविशेषे अन्तर्भूतेषु पृष्ठेषु परिवर्तनानि)।

भवतः निरीक्षासूचिकायां धारितानि पृष्ठाणि '''स्थूलाक्षरैः''' दर्शितानि।",
'recentchangeslinked-page'    => 'पृष्ठ-नाम :',
'recentchangeslinked-to'      => 'अस्य स्थाने इदं पृष्ठं प्रति संबद्धानां पृष्ठाणां परिवर्तनानि दर्शयतु',

# Upload
'upload'        => 'संचिकाम् उद्भारयतु',
'uploadlogpage' => 'उद्भारण-सूचिका',
'uploadedimage' => '"[[$1]]" इत्येतद् उद्भारितमस्ति',

# Special:ListFiles
'imgfile' => 'संचिका',

# File description page
'filehist'                  => 'संचिकायाः इतिहासः',
'filehist-help'             => 'संचिका तत्समये कीदृशी आसीदिति द्रष्टुं दिनांकः/समयः इत्यस्मिन् नोदयतु।',
'filehist-deleteone'        => 'विलोप',
'filehist-current'          => 'नवीनतमम्',
'filehist-datetime'         => 'दिनांकः/समयः',
'filehist-thumb'            => 'अंगुष्ठनखाकारम्',
'filehist-user'             => 'प्रयोक्ता',
'filehist-dimensions'       => 'आयामाः',
'filehist-comment'          => 'टिप्पणी',
'imagelinks'                => 'संचिका-संबंधनानि',
'linkstoimage'              => '{{PLURAL:$1|अधोलिखितं पृष्ठं| अधोलिखितानि $1 पृष्ठाणि}} इदं संचिकां प्रति संबंधनं {{PLURAL:$1|करोति| कुर्वन्ति}}।',
'uploadnewversion-linktext' => 'अस्य पृष्ठस्य नूतनाम् आवृत्तिं उद्भारयतु',

# Random page
'randompage' => 'अविशिष्ट पृष्ठ',

# Statistics
'statistics' => 'सांख्यिकी',

# Miscellaneous special pages
'nbytes'        => '$1 {{PLURAL:$1|बैटम्|बैटानि}}',
'nmembers'      => '$1 {{PLURAL:$1|सदस्यः|सदस्याः}}',
'prefixindex'   => 'पूर्वलग्नेन सहितानि सर्वाणि पृष्ठाणि',
'longpages'     => 'दीर्घाणि पृष्ठाणि',
'newpages'      => 'नूतनानि पृष्ठाणि',
'ancientpages'  => 'प्राचीनतम् पृष्ठा',
'move'          => 'नाम परिवर्तयतु',
'movethispage'  => 'इदं पृष्ठं चालयतु',
'pager-newer-n' => '{{PLURAL:$1|नूतनतरम् 1|नूतनतराणि $1}}',
'pager-older-n' => '{{PLURAL:$1|पुरातनतरम् 1|पुरातनतराणि $1}}',

# Book sources
'booksources'               => 'पुस्तक-स्रोतांसि',
'booksources-search-legend' => 'पुस्तक-स्रोतांसि अन्विष्यतु',
'booksources-go'            => 'प्रस्थानम्',

# Special:Log
'log' => 'लॉग् इत्येतानि',

# Special:AllPages
'allpages'       => 'सकलानि पृष्ठाणि',
'alphaindexline' => '$1 इत्यस्मात् $2 इतीदं यावत्',
'prevpage'       => 'पूर्वपृष्ठं ($1)',
'allpagesfrom'   => 'इत्यस्मात् आरभमन्तः पृष्ठाणि दर्शयतु :',
'allpagesto'     => 'दर्शयतु पृष्ठाणि येषाम् अंतम् एवम् :',
'allarticles'    => 'सर्वाणि पृष्ठाणि',
'allpagessubmit' => 'गच्छतु',

# Special:Categories
'categories' => 'वर्ग',

# Special:LinkSearch
'linksearch' => 'बाह्य-संबंधनानि',

# Special:Log/newusers
'newuserlogpage'          => 'प्रयोक्तृ-सृजन-सूचिका',
'newuserlog-create-entry' => 'नूतन-प्रयोक्तृ-लेखा',

# Special:ListGroupRights
'listgrouprights-members' => '(सदस्यानां सूचिका)',

# E-mail user
'emailuser'    => 'एनं प्रयोक्तारं विद्युत्पत्रं (ई-मेल् इत्येतद्) प्रेषयतु',
'emailsubject' => 'विषयः',
'emailmessage' => 'सन्देशः :',

# Watchlist
'watchlist'         => 'मम निरीक्षासूचिका',
'mywatchlist'       => 'मम निरीक्षासूचिका',
'watchlistfor'      => "('''$1''' इत्यस्य कृते)",
'addedwatch'        => 'निरीक्षासूचिकायां योजितम्',
'addedwatchtext'    => 'भवतः [[Special:Watchlist|ध्यानसूचिकायां]] "[[:$1]]" इत्येतत् योजितमस्ति।
इदानींप्रभृति अस्मिन् पृष्ठे तथा अस्य चर्चापृष्ठे सन्तः परिवर्तनानि भवतः निरीक्षासूचिकायां द्रक्ष्यन्ते तथा च [[Special:RecentChanges|सद्यःपरिवर्तितानां सूचिकायां]] इदं पृष्ठं स्थूलाक्षरैः द्रक्ष्यते, यस्मात् भवान् सरलतया इदं पश्यतु <p>निरीक्षासूचिकातः निराकर्तुमिच्छति चेत्, "मा निरीक्षताम्" इत्यसमिन् नोदयतु।',
'removedwatch'      => 'निरीक्षासूचिकातः निराकृतम्।',
'removedwatchtext'  => '"[[:$1]]" इति पृष्ठं [[Special:Watchlist|भवतः निरीक्षासूचिकातः]] निराकृतमस्ति।',
'watch'             => 'निरीक्षताम्',
'watchthispage'     => 'इदं पृष्ठं निरीक्षताम्',
'unwatch'           => 'मा निरीक्षताम्',
'watchlist-details' => '{{PLURAL:$1|$1 पृष्ठं|$1 पृष्ठाणि}} भवतः निरीक्षासूचिकायां सन्ति, संभाषणपृष्ठाणि नात्र गणितानि।',
'wlshowlast'        => 'अंतिमानि ($1 होराः $2 वासराः) $3 इति दर्शयतु',
'watchlist-options' => 'निरीक्षा-सूचिका विकल्पाः',

# Displayed when you click the "watch" button and it is in the process of watching
'watching'   => 'निरीक्षते...',
'unwatching' => 'निरीक्षाम् अपाकरोति...',

# Delete
'deletepage'            => 'पृष्ठं निराकरोतु।',
'actioncomplete'        => 'कार्य समापनम्',
'deletedtext'           => '"<nowiki>$1</nowiki>" इत्येतद् अपाकृतमस्ति।
सद्यःकृतानां अपाकरणानाम् अभिलेखः $2 इत्यस्मिन् पश्यतु।',
'deletedarticle'        => '"[[$1]]" अपाकृतमस्ति।',
'dellogpage'            => 'अपाकरणानां सूचिका',
'deletecomment'         => 'निराकरणस्य कारणम् :',
'deleteotherreason'     => 'अपरं/अतिरिक्तं कारणम् :',
'deletereasonotherlist' => 'इतर कारणम्',

# Rollback
'rollbacklink' => 'पूर्ण-प्रतिगमनम्',

# Protect
'protectlogpage'              => 'सुरक्षा-सूचिका',
'protectedarticle'            => '"[[$1]]" इत्येतद् सुरक्षितीकृतमस्ति',
'modifiedarticleprotection'   => '"[[$1]]" इत्येतदर्थं सुरक्षा-स्तरः परिवर्तित: :',
'protectcomment'              => 'कारणम् :',
'protectexpiry'               => 'अवसानम् :',
'protect_expiry_invalid'      => 'अवसान-समयः अमान्योऽस्ति।',
'protect_expiry_old'          => 'अवसान-समयः अतीतोऽस्ति।',
'protect-unchain'             => 'चालनार्थम् अनुज्ञां ददातु।',
'protect-text'                => "'''<nowiki>$1</nowiki>''' इति पृष्ठस्य कृते सुरक्षा-स्तरं भवान् अत्र दृष्टुं शक्नोति, तथा च तं परिवर्तयितुं शक्नोति।",
'protect-locked-access'       => "भवान् अस्य पृष्ठस्य सुरक्षा-स्तरं परिवर्तयितुम् अनुज्ञां न धारयति। '''$1''' इति पृष्ठस्य अधुनातनः सुरक्षा-स्तरः :",
'protect-cascadeon'           => 'इदं पृष्ठं वर्तमत्काले सुरक्षितमस्ति, यत इदं {{PLURAL:$1|निम्नलिखिते पृष्ठे |निम्नलिखितेषु पृष्ठेषु}} समाहितमस्ति {{PLURAL:$1|यस्मिन्|येषु}} सोपानात्मिका सुरक्षा प्रभाविनी अस्ति। भवान् अस्य पृष्ठस्य सुरक्षा-स्तरं परिवर्तयितुं शक्नोति, परं तेन सोपानात्मिका-सुरक्षा न परिवर्तयिष्यति।',
'protect-default'             => 'सर्वान् प्रयोक्तॄन् अनुज्ञापयतु।',
'protect-fallback'            => '"$1" अनुज्ञा आवश्यकी।',
'protect-level-autoconfirmed' => 'नूतनान् तथा अपंजीकृतान् प्रयोक्तॄन् निरुध्नातु।',
'protect-level-sysop'         => 'प्रबंधकाः केवलाः',
'protect-summary-cascade'     => 'सोपानात्मकम्',
'protect-cascade'             => 'अस्मिन् पृष्ठे समाहितानि पृष्ठाणि सुरक्षितानि करोतु (सोपानात्मिका सुरक्षा)।',
'protect-cantedit'            => 'भवान् अस्य पृष्ठस्य सुरक्षा-स्तरं परिवर्तयितुं न शक्नोति, यतो भवान् इदं पृष्ठं संपादयितुं अनुज्ञां न धारयति।',
'restriction-type'            => 'अनुमतिः:',
'restriction-level'           => 'सुरक्षा-स्तरः :',

# Undelete
'undeletelink'     => 'दर्शयतु/पुनःस्थापयतु',
'undeletedarticle' => '"[[$1]]" इत्येतद् पुनःस्थापितमस्ति।',

# Namespace form on various pages
'namespace'      => 'नामाकाशः :',
'invert'         => 'चयनं विपरीतीकरोतु',
'blanknamespace' => '(मुख्यः)',

# Contributions
'contributions' => 'प्रयोक्तॄणां योगदानानि',
'mycontris'     => 'मम योगदानानि',
'contribsub2'   => '$1 इत्येतदर्थम् ($2)',
'uctop'         => '(शीर्षम्)',
'month'         => 'अस्मात् मासात् (पुरातनतराणि च):',
'year'          => 'अस्मात् वर्षात् (पूर्वतराणि च):',

'sp-contributions-newbies'  => 'केवलानां नूतन-लेखानां योगदानानि दर्शयतु',
'sp-contributions-blocklog' => 'निरोधानां सूचिका',
'sp-contributions-search'   => 'योगदानानां कृते अन्विष्यतु',
'sp-contributions-username' => 'आइ.पी.संकेतः अथवा प्रयोक्तृ-नाम :',
'sp-contributions-submit'   => 'अन्वेषणम्',

# What links here
'whatlinkshere'            => 'केभ्यः पृष्ठेभ्यः सम्बद्धम्',
'whatlinkshere-title'      => '"$1" इत्यस्मात् संबंधितानि पृष्ठाणि',
'whatlinkshere-page'       => 'पृष्ठम् :',
'linkshere'                => "अधोलिखितानि पृष्ठाणि '''[[:$1]]''' इत्येतद् प्रति संबंधनं कुर्वन्ति :",
'isredirect'               => 'अनुप्रेषण-पृष्ठम्',
'istemplate'               => 'मिलापयतु',
'isimage'                  => 'चित्र-संबंधनम्',
'whatlinkshere-prev'       => '{{PLURAL:$1|पूर्वतनम्|पूर्वतनानि $1}}',
'whatlinkshere-next'       => '{{PLURAL:$1|आगामि|आगामिनि $1}}',
'whatlinkshere-links'      => '← संबंधनानि',
'whatlinkshere-hideredirs' => '$1 अनुप्रेषणानि',
'whatlinkshere-hidetrans'  => '$1 मिलापनानि (ट्रांस्क्लुसन् इत्येतानि)',
'whatlinkshere-hidelinks'  => '$1 संबंधनानि',
'whatlinkshere-filters'    => 'निस्यन्दनानि',

# Block/unblock
'blockip'                  => 'प्रयोक्तारं निरुध्नातु',
'ipboptions'               => '२ होराः:2 hours,१ वासरः:1 day,३ वासराः:3 days,१ सप्ताहः:1 week,२ सप्ताहौ:2 weeks,१ मासः:1 month,३ मासाः:3 months,६ मासाः:6 months,१ वर्षः:1 year,अनंतम्:infinite', # display1:time1,display2:time2,...
'ipblocklist'              => 'निरोधिताः आइ.पी. संकेताः, प्रयोक्तृ-नामानि च',
'blocklink'                => 'अवरुध्नातु',
'unblocklink'              => 'अनिरुध्नातु',
'contribslink'             => 'योगदानम्',
'blocklogpage'             => 'निरोधानां सूचिका',
'blocklogentry'            => '[[$1]] इत्येतद् निरोधितं, $2 $3 इति अवसान-समयेन सह',
'unblocklogentry'          => 'अनिरुद्धम् $1',
'block-log-flags-nocreate' => 'लेखा-सृजनम् अक्षमीकृतम्',

# Move page
'movearticle'     => 'पृष्ठं चालयतु :',
'newtitle'        => 'नूतनं शीर्षकं प्रति :',
'move-watch'      => 'इदं पृष्ठं निरीक्षताम्।',
'movepagebtn'     => 'पृष्ठं चालयतु।',
'pagemovedsub'    => 'चालनं सिद्धम्।',
'movepage-moved'  => '<big>\'\'\'"$1" इत्येतद् "$2" इत्येतद् प्रति चालितमस्ति \'\'\'</big>', # The two titles are passed in plain text as $3 and $4 to allow additional goodies in the message.
'articleexists'   => 'अनेन नाम्ना पृष्ठमेकं पूर्वेऽपि विद्यते, अथवा भवता चितं नाम तु अमान्यमस्ति। कृपया इतरं किमपि नाम चिनोतु।',
'talkexists'      => "'''पृष्ठं साफल्येन चालितमस्ति, परं चर्चापृष्ठं चालयितुं न शक्यम्, यतो नवेऽपि पृष्ठे चर्चापृष्ठं विद्यते। कृपया तं स्वयमेव चालयतु।'''",
'movedto'         => 'इदं प्रति चालितम्।',
'movetalk'        => 'सहगामिनं चर्चापृष्ठं चालयतु।',
'1movedto2'       => '[[$1]] इत्येतद् [[$2]] इत्येतद् प्रति चालितम्',
'1movedto2_redir' => '[[$1]] इति लेखस्य नाम परिवर्तितं कृत्वा [[$2]] इति कृतम् (अनुप्रेषितम्)',
'movelogpage'     => 'लॉग् इत्येतद् चालयतु',
'movereason'      => 'कारणम् :',
'revertmove'      => 'पुरातनीं आवृत्तिं प्रति गमयतु',

# Export
'export' => 'पृष्ठाणां निर्यातं करोतु',

# Namespace 8 related
'allmessages'     => 'व्यवस्था सन्देशाः',
'allmessagesname' => 'नाम',

# Thumbnails
'thumbnail-more' => 'विस्तारयतु',

# Special:Import
'import-comment' => 'टिप्पणी:',

# Tooltip help for the actions
'tooltip-pt-userpage'             => 'भवतः प्रयोक्तृ-पृष्ठम्',
'tooltip-pt-mytalk'               => 'भवतः संभाषण-पृष्ठम्',
'tooltip-pt-preferences'          => 'भवतः वरीयांसि',
'tooltip-pt-watchlist'            => 'भवद्भिः निरीक्ष्यमतां पृष्ठाणां सूचिका',
'tooltip-pt-mycontris'            => 'भवतः योगदानानां सूचिका',
'tooltip-pt-login'                => 'भवान् लेखायां प्रविशतु इति श्रेयः परन्तु नावश्यकम्',
'tooltip-pt-logout'               => 'बहिर्गच्छतु',
'tooltip-ca-talk'                 => 'घटक-पृष्ठ-विषये चर्चा',
'tooltip-ca-edit'                 => 'भवान् इदं पृष्ठं संपादयितुं शक्नोति। कृपया रक्षणात्पूर्वं प्राग्दृश्यं पश्यतु।',
'tooltip-ca-addsection'           => 'नूतनं विभागम् आरभतु',
'tooltip-ca-viewsource'           => 'इदं पृष्ठं सुरक्षितं विद्यते। भवान् अस्य स्रोतसम् दृष्टुं शक्नोति।',
'tooltip-ca-history'              => 'अस्य पृष्ठस्य पुरातनाः आवृत्तयः',
'tooltip-ca-protect'              => 'इदं पृष्ठं सुरक्षितीकरोतु',
'tooltip-ca-delete'               => 'इदं पृष्ठं अपाकरोतु',
'tooltip-ca-move'                 => 'इदं पृष्ठं चालयतु',
'tooltip-ca-watch'                => 'इदं पृष्ठं स्व-निरीक्षासूचिकायां योजयतु।',
'tooltip-ca-unwatch'              => 'इदं पृष्ठं स्व-निरीक्षासूचिकातः अपाकरोतु',
'tooltip-search'                  => '{{SITENAME}} अन्वेषणं करोति',
'tooltip-search-go'               => 'एतत्-शीर्षकीयम् पृष्ठं गच्छतु चेत् तद्वर्तते',
'tooltip-search-fulltext'         => 'एतत् पाठं पृष्ठेषु अन्विष्यतु',
'tooltip-p-logo'                  => 'मुख्यपृष्ठम्  अभ्यागम्',
'tooltip-n-mainpage'              => 'मुख्यपृष्ठं संदर्शयतु',
'tooltip-n-portal'                => 'प्रकल्पविषये, भवता किं कर्तुं शक्यम्, कुत्र अन्वेषणं शक्यम्',
'tooltip-n-currentevents'         => 'सद्यःघटितानां घटनानां विषये पृष्ठभूमिक-सूचना',
'tooltip-n-recentchanges'         => 'सद्यःपरिवर्तितानां सूचिका',
'tooltip-n-randompage'            => 'यादृच्छिकमेकं पृष्ठं गच्छतु',
'tooltip-n-help'                  => 'निराकरण-स्थानम्',
'tooltip-t-whatlinkshere'         => 'सर्वेषामपि एतत्संबद्धानां पृष्ठानां सूची',
'tooltip-t-recentchangeslinked'   => 'अस्मात् पृष्ठात् संबंद्धीकृतेषु पृष्ठेषु नवीनतमानि परिवर्तनानि',
'tooltip-feed-rss'                => 'अस्मै पृष्ठाय आर-एस-एस-पूरणम्',
'tooltip-feed-atom'               => 'अस्मै पृष्ठाय ऍटम-पूरणम्',
'tooltip-t-contributions'         => 'अस्य प्रयोक्तारः योगदानानां सूचिकां दर्शयतु',
'tooltip-t-emailuser'             => 'एनं प्रयोक्तारं विद्युत्पत्रं(ई-मेल इत्येतद्) प्रेषयतु',
'tooltip-t-upload'                => 'संचिकाः उद्भारयतु',
'tooltip-t-specialpages'          => 'सर्वेषां विशिष्ट-पृष्ठानां सूचिका',
'tooltip-t-print'                 => 'अस्य पृष्ठस्य मुद्रणीया आवृत्तिः',
'tooltip-t-permalink'             => 'पृष्ठस्य इमाम् आवृत्तिं प्रति स्थायि संबंधनम्',
'tooltip-ca-nstab-main'           => 'घटक-पृष्ठं पश्यतु',
'tooltip-ca-nstab-user'           => 'प्रयोक्तॄ-पृष्ठं दर्शयतु',
'tooltip-ca-nstab-special'        => 'इदमेकं विशिष्टं पृष्ठम्, भवान् इदं पृष्ठं संपादयितुं न शक्नोति।',
'tooltip-ca-nstab-project'        => 'प्रकल्प-पृष्ठं दर्शयतु',
'tooltip-ca-nstab-image'          => 'संचिकायाः पृष्ठं पश्यतु',
'tooltip-ca-nstab-template'       => 'बिंबधरं पश्यतु',
'tooltip-ca-nstab-category'       => 'श्रेणी-पृष्ठं दर्शयतु',
'tooltip-minoredit'               => 'इदं परिवर्तनं लघु-परिवर्तन-रूपेण दर्शयतु',
'tooltip-save'                    => 'परिवर्तनानि रक्षतु',
'tooltip-preview'                 => 'भवता कृतानि परिवर्तनानि प्राग्दृश्यरूपेण पश्यतु, कृपया रक्षणात्पूर्वं इदं प्रयोजयतु।',
'tooltip-diff'                    => 'पाठे भवता कृतानि परिवर्तनानि पश्यतु।',
'tooltip-compareselectedversions' => 'पृष्ठस्य द्वयोः चितयोः आवृत्त्योः मध्ये अंतरं पश्यतु',
'tooltip-watch'                   => 'इदं पृष्ठं स्व-निरीक्षासूचिकायां योजयतु',
'tooltip-rollback'                => '"पूर्ण-प्रतिगमनं(रोलबैक् इत्येतद्)" अस्य पृष्ठस्य संपादनानि अंतिम-योगदातृकृतानि विपरीतीकरोति एकेन क्लिक्कारेण',
'tooltip-undo'                    => '"अकरोतु" इत्येतद् इदं संपादनं विपरीतीकरोति, तथा च संपादन-प्रारूपं प्राग्दृश्य-रूपेण उद्घाटयति।

अस्य सारांशे कारणमपि लेखितुं शक्यते।',

# Skin names
'skinname-standard'    => 'पूर्व',
'skinname-nostalgia'   => 'पुराण',
'skinname-cologneblue' => 'नील',
'skinname-monobook'    => 'पुस्तक',
'skinname-myskin'      => 'मे चर्मन्',
'skinname-chick'       => 'Chick',

# Browsing diffs
'previousdiff' => '← पुरातनतरं संपादनम्',
'nextdiff'     => 'नवतरं संपादनम् →',

# Media information
'file-info-size'       => '($1 × $2 पिक्सेलानि, संचिकायाः आकारः: $3, MIME-प्रकारः: $4)',
'file-nohires'         => '<small>उच्चतरं विभेदनं नोपलब्धम्</small>',
'svg-long-desc'        => '(SVG संचिका, साधारणतया $1 × $2 पिक्सेलानि, संचिकायाः आकारः : $3)',
'show-big-image'       => 'पूर्णं विभेदनम्',
'show-big-image-thumb' => '<small>अस्य प्राग्दृश्यस्य आकारः : $1 × $2 पिक्सेलानि</small>',

# Special:NewFiles
'newimages' => 'नूतन-संचिकानां वीथिका',

# Bad image list
'bad_image_list' => 'प्रारूपम् एवम् अस्ति :

केवलानि सूचिकान्तर्गतानि वस्तूनि विचारितानि सन्ति (* इत्यस्मात् आरभमत्यः पंक्तयः)। पंक्त्यां प्रथमं संबंधनं त्रुटिपूर्णां संचिकां प्रति भवतु।

पंक्तौ परवर्तिनः संबंधनानि अपवादान् इव विचार्यन्ते, अर्थात् तादृशानि पृष्ठाणि यत्र संचिकैषा भवितुं शक्नोति।',

# Metadata
'metadata'          => 'अधिदत्तानि',
'metadata-help'     => 'अस्यां संचिकायां अतिरिक्ता सूचना अस्ति, कदाचित् आंकिक-छायाचित्रग्राहिना अथवा स्कैनर् इत्यनेन योजिता येन एषा स्रष्टा वा आंकिकीकृता वा स्यात्।

यदि एषा संचिका मूलावस्थातः परिवर्तिता अस्ति, तदा अत्र कानिचिद् विवरणानि परिवर्तितां संचिकां न पूर्णतया प्रदर्शयन्तीति शक्यम्।',
'metadata-expand'   => 'विस्तारितानि विवरणानि दर्शयतु',
'metadata-collapse' => 'विस्तारितानि विवरणानि लोपयतु',
'metadata-fields'   => 'अस्मिन् तालिकायां दर्शिता सूचना संचिकायाः अधस्तात् मेटाडाटा इत्यस्मिन् सदा दर्शिता भविष्यति।

अवशिष्टा सूचना सदा निगूढा भविष्यति।

* make
* model
* datetimeoriginal
* exposuretime
* fnumber
* isospeedratings
* focallength', # Do not translate list items

# External editor support
'edit-externally'      => 'बाह्यां प्रणालीं उपयोज्य इमां संचिकां संपादयतु।',
'edit-externally-help' => '(अधिकायै सूचनायै [http://www.mediawiki.org/wiki/Manual:External_editors setup instructions] इत्येतत् पश्यतु)',

# 'all' in various places, this might be different for inflected languages
'watchlistall2' => 'सर्वाणि',
'namespacesall' => 'सर्वाणि',
'monthsall'     => 'सर्वाः',

# Auto-summaries
'autosumm-new' => '$1 नवीन पृष्ठं निर्मीत अस्ती',

# Watchlist editing tools
'watchlisttools-view' => 'आधारितानि परिवर्तनानि दर्शयतु',
'watchlisttools-edit' => 'निरीक्षासूचिकां दर्शयतु, संपादयतु च',
'watchlisttools-raw'  => 'प्राकृतां निरीक्षासुचिकां संपादयतु',

# Special:Version
'version' => 'आवृत्ति', # Not used as normal message but as header for the special page itself

# Special:SpecialPages
'specialpages' => 'विशिष्ट-पृष्ठाणि',

);
