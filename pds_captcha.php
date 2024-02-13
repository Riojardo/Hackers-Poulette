<?php
/*
                                                    _                                  _             __      
                                                   | |                                (_)           / _|     
  _ __   __ _ ___ ___  ___ _   _ _ __ ___ ______ __| | ___ ______ ___  __ ___   _____  _ _ __ ___  | |_ _ __ 
 | '_ \ / _` / __/ __|/ _ \ | | | '__/ __|______/ _` |/ _ \______/ __|/ _` \ \ / / _ \| | '__/ __| |  _| '__|
 | |_) | (_| \__ \__ \  __/ |_| | |  \__ \     | (_| |  __/      \__ \ (_| |\ V / (_) | | |  \__ \_| | | |   
 | .__/ \__,_|___/___/\___|\__,_|_|  |___/      \__,_|\___|      |___/\__,_| \_/ \___/|_|_|  |___(_)_| |_|   
 | |                                                                                                         
 |_|                                                                                                         

pds_captcha.php - un captcha mathématique
bidouillé par passeurs de savoirs<br>
plus d'infos sur 
http://passeurs-de-savoirs.fr/lab/lab2015/captcha-math.php
*/
function pdscaptcha($etape){
if ($etape=="question")
{
$messageinfos="Pour des raisons de sécurité, et et éviter le spam, merci de résoudre l'opération suivante :";
$tchiffres=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,
                 21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,
                 41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,
                 61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,
                 81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99);

$tlettres=array("zéro","un","deux","trois","quatre","cinq","six","sept","huit","neuf",
                "dix","onze","douze","treize","quatorze","quinze","seize","dix-sept",
                "dix-huit","dix-neuf","vingt","vingt et un","vingt-deux","vingt-trois",
                "vingt-quatre","vingt-cinq","vingt-six","vingt-sept","vingt-huit",
                "vingt-neuf","trente","trente et un","trente-deux","trente-trois",
                "trente-quatre","trente-cinq","trente-six","trente-sept","trente-huit",
                "trente-neuf","quarante","quarante et un","quarante-deux","quarante-trois",
                "quarante-quatre","quarante-cinq","quarante-six","quarante-sept",
                "quarante-huit","quarante-neuf","cinquante","cinquante et un",
                "cinquante-deux","cinquante-trois","cinquante-quatre","cinquante-cinq",
                "cinquante-six","cinquante-sept","cinquante-huit","cinquante-neuf",
                "soixante","soixante et un","soixante-deux","soixante-trois",
                "soixante-quatre","soixante-cinq","soixante-six","soixante-sept",
                "soixante-huit","soixante-neuf","soixante-dix","soixante et onze",
                "soixante-douze","soixante-treize","soixante-quatorze","soixante-quinze",
                "soixante-seize","soixante-dix-sept","soixante-dix-huit","soixante-dix-neuf",
                "quatre-vingts","quatre-vingt-un","quatre-vingt-deux","quatre-vingt-trois",
                "quatre-vingt-quatre","quatre-vingt-cinq","quatre-vingt-six",
                "quatre-vingt-sept","quatre-vingt-huit","quatre-vingt-neuf","quatre-vingt-dix",
                "quatre-vingt-onze","quatre-vingt-douze","quatre-vingt-treize",
                "quatre-vingt-quatorze","quatre-vingt-quinze","quatre-vingt-seize",
                "quatre-vingt-dix-sept","quatre-vingt-dix-huit","quatre-vingt-dix-neuf",
                "cent");
				
$premier=rand ( 0 , count($tchiffres)-1 );
$second=rand ( 0 , count($tchiffres)-1 );
$choixsigne=rand ( 0 ,1 );
if($second<=$premier && $choixsigne==1 )
{
	$resultat=md5($tchiffres[$premier]-$tchiffres[$second]);
	$operation="combien font ".$tlettres[$premier]." retranché de ".$tlettres[$second]." ?";
}
else if($second<=$premier && $choixsigne==0 )
{
	$resultat=md5($tchiffres[$premier]-$tchiffres[$second]);
	$operation="combien font ".$tlettres[$premier]." moins ".$tlettres[$second]." ?";
}
else if ($second>$premier && $choixsigne==1 )
{
	$resultat=md5($tchiffres[$premier]+$tchiffres[$second]);
	$operation="combien font ".$tlettres[$premier]." ajouté à ".$tlettres[$second]." ?";
	
}
else
{
	$resultat=md5($tchiffres[$premier]+$tchiffres[$second]);
	$operation="combien font ".$tlettres[$premier]." plus ".$tlettres[$second]." ?";
	
}
$o="";
foreach (mb_str_split($operation) as $obj) {
    $o .= "&#".mb_ord($obj).";";
}

$champquestion="<p>
<label for=\"reponsecap\">".$messageinfos."<br>\n<br /><u>".$o."</u> <em>(en chiffres)</em>&nbsp;</label>\n<input type=\"text\" name=\"reponsecap\" value=\"\" />\n<input name=\"reponsecapcode\" type=\"hidden\" value=\"".$resultat."\" /></p>";
return $champquestion;
}
else
{
if (md5(htmlspecialchars($etape["reponsecap"]))==htmlspecialchars($etape["reponsecapcode"]))
{ return true;}
else
{return false;}
}
}

?>