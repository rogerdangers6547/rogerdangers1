<!-- saved from url=(0038)http://www.cc-cheker.esy.es/Extrap.php -->
<html><head><meta charset="utf-8"><title>Gerador De CC Roger Dangers</title>
<SCRIPT LANGUAGE="JavaScript1.2">
document.onkeypress = verificaBotao;
document.onkeydown = verificaBotao;
document.oncontextmenu = alerta;
</script>
<script language="JavaScript" type="text/javascript">
<!--------------------------------------------------------
// ---------------------------------------------------------
// JavaScript untuk Extrap Credit Card
// (c) 2000 oleh Olga.Taufani.ST - Modified By Roger Dangers
// ---------------------------------------------------------

//menghilangkan spasi dan "-" baik di awal, di tengah maupun di akhir string
function trimSpaces(s){
        var res;
        var i;
        res = "";
        for (i = 0; i < s.length; i++){
                if ((s.charAt(i) != " ") && (s.charAt(i) != "-"))
                        res += s.charAt(i);
        }
        return res;
}

//mengembalikan benar jika input yang diberikan benar (semuanya angka)
//string dianggap telah dilewatkan ke trimSpaces
function isValidInput(s){
        for (i = 0; i < s.length; i++){
                var i;
                if ((s.charAt(i) < "0") || (s.charAt(i) > "9"))
                        return false;
        }
        return true;
}

//membatasi angka agar tidak lebih dari 9
function fix(num){
        if (num <= 9) return num; else return (num - 9);
}

//untuk mengecek kebenaran dengan >> luhn check digit algorithm <<
function check(number){
        var i;
        var ganjil;
        var genap;
        var tanda;

        genap = 0;
        ganjil = 0;
        //tanda = 1 artinya jumlah digitnya ganjil
        if (number.length % 2) tanda = 0; else tanda = 1;
        for (i = 0; i < number.length; i++) {
                if ((i + tanda) % 2) //ganjil
                        ganjil += fix(2 * (number.charAt(i)));
                else
                        genap += parseInt(number.charAt(i), 10);
        }
        return (((ganjil + genap) % 10) == 0);
}

//fungsi utama
function validateInput(inp){
        var tmp;
        var Msg;
        var Msg2;
        tmp = trimSpaces(inp.nomor.value)
        if ((tmp == "") || (!isValidInput(tmp))){
                alert("Preencha os campos!");
                return false;
        }
        Msg = "4LV3S";
        Msg2 = "";
        if (check(tmp))
                alert(Msg + "\n\nVALID!!\n\n" + Msg2);
        else
                alert(Msg + "\n\nTIDAK VALID!!\nPreencha os campos.\n\n" + Msg2);
        return false;
}

//mencari beberapa angka valid yang dekat dengan nomor yang diberikan
function findN(formName){
        var start;
        var startn;
        var res;
        var i;
  var exp;
  var cvv;
  var delim;

        expH = trimSpaces(formName.exp.value);
        cvvH = trimSpaces(formName.cvv.value);
        delimH = trimSpaces(formName.delim.value);
        start = trimSpaces(formName.nomor.value);
        if ((start == "") || (!isValidInput(start))){
                alert("Preencha os campos!");
                return;
        }
        res = "";
        startn = parseInt(start,10);
        for (i=-50; i<10000; i++)  {
                num = "" + (parseInt(start,10)+i);
                if (check(num)) {
                        res += (startn + i) + delimH + expH + delimH + cvvH + "\n";
                }
        }
        formName.hasil.value = res;
}
//
//akhir skrip di sini
//
//------------------------------------------------------->

   
</script></head><body><b>
<header>
<div id="fb-root"></div>
</b><center><b>
<font color="white" face="Bedini" size="4">Dados do Cartão:</font></b>
<form name="InpForm" onsubmit="return validateInput(this);">
<input type="TEXT" name="nomor" placeholder="4342564995890000">
<input type="TEXT" name="exp" placeholder="01|16">
<input type="TEXT" name="cvv" value="999">
<input type="TEXT" name="delim" value="|" size="1"><br><br>
<input type="BUTTON" name="buat" onclick="findN(InpForm)" value="Gerar">
<p><textarea name="hasil" cols="60" rows="10"></textarea>
</p><div id="jumlah" style="display: none;"></div><br></form>
