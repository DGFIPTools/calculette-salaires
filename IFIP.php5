<!DOCTYPE html>
<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
 <link rel="stylesheet" type="text/css" href="styles/adaptive.css"/>
  <link rel="stylesheet" type="text/css" href="styles/formulaire.css"/>
<title>Calcul traitement et salaire inspecteur des finances publiques</title>
<META name="keywords" content="salaire, calculateur, TSPEI, TSDD, TSPDD, TSCDD, TSCEI, CFiP, CTRL, Contrôleur des finances publiques">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
</head>

  <body>
    <form action="/IFIP1.php5" method="post" name="ts" target="_parent">
      <div style="text-align: center;"> <span style="font-family: Courier new,Arial,sans-serif;"><br>
        </span></div>
      <br>
      <table  border="0" cellpadding="2" cellspacing="1"
        align="center">
        <tbody>
          <tr>
            <td style="background-color: white; text-align: center;" valign="bottom"><font
                size="3"
                face="Arial, Helvetica, sans-serif"><strong><font
                    size="3"
                    face="Arial, Helvetica, sans-serif"><strong><a href="mailto:tatam3x@gmail.com"<span
                        style="color: #2257f6;">T3X</span></a>&nbsp
                      </strong></font>Simulation de salaire des Inspecteurs des finances publiques  &nbsp</strong></font><font size="3" face="Arial, Helvetica, sans-serif"><strong>
                </strong></font></td>
            <td><br>
            </td>
            <td valign="top" align="right"> <br>
              <font size="1" face="Arial, Helvetica, sans-serif" color="#666666"><strong></strong></font>
            </td>
          </tr>
          <tr>
            <td>
              <table width="75%" border="0" cellpadding="0" cellspacing="0" align="left">
              </table>
            </td>
          </tr>
        </tbody>
      </table>
      <table align="center">
        <tbody>
          <tr>
            <td class="formName" style="text-align: right;">Echelon<br>
            </td>
            <td class ="formValue" >
              <select class="autosize" required="required" name="Echelon">
			    <option selected="selected" value="13">Inspecteur stagiaire 1er échelon</option>
                <option value="14">Inspecteur stagiaire 2ème échelon</option>
                <option value="15">Inspecteur stagiaire 3ème échelon</option>
                <option value="16">Inspecteur stagiaire 4ème échelon</option>
                <option value="17">Inspecteur stagiaire 5ème échelon</option>
                <option value="18">Inspecteur stagiaire 6ème échelon</option>
                <option value="19">Inspecteur stagiaire 7ème échelon</option>
                <option value="20">Inspecteur stagiaire 8ème échelon</option>
                <option value="21">Inspecteur stagiaire 9ème échelon</option>
                <option value="22">Inspecteur stagiaire 10ème échelon</option>
                <option value="23">Inspecteur stagiaire 11ème échelon</option>
                <option value="24">Inspecteur stagiaire 12ème échelon </option>
                <option value="1">Inspecteur 1er échelon</option>
                <option value="2">Inspecteur 2ème échelon</option>
                <option value="3">Inspecteur 3ème échelon</option>
                <option value="4">Inspecteur 4ème échelon</option>
                <option value="5">Inspecteur 5ème échelon</option>
                <option value="6">Inspecteur 6ème échelon</option>
                <option value="7">Inspecteur 7ème échelon</option>
                <option value="8">Inspecteur 8ème échelon</option>
                <option value="9">Inspecteur 9ème échelon</option>
                <option value="10">Inspecteur 10ème échelon</option>
                <option value="11">Inspecteur 11ème échelon</option>
                <option value="12">Inspecteur 12ème échelon </option>
              
              </select>
            </td>
          </tr>
          
		  
		  
		  <tr>
            <td class="formName" style="text-align: right;">Provenance des stagiaires<br>
            </td>
            <td class="formValue">
              <select class="autosize" required="required" name="Stag">
			  <option selected="selected" value="0">Externe sans reprise d'ancienneté</option>
                <option  value="1">Externe avec reprise d'ancienneté</option>
                <option value="2">Interne Ex-Cat C AAP1 AAP2 ou ex-Cat B ou Ex-Cat A</option>
            
              </select>
              <br>
            </td>
          </tr>
		  <tr>
            <td class="formName" style="text-align: right;">Prime Informaticiens<br>
            </td>
            <td class="formValue">
              <select class="autosize" required="required" name="TAI">
			  <option selected="selected" value="0">Pas de TAI</option>   
 <option value="1">PSE  depuis moins d'un an</option>  
 <option value="2">PSE depuis plus d'un an mais moins de 2 ans et demi</option>  
 <option value="3">PSE au delà de 2 ans et demi</option>  
  <option value="4">Analyste depuis moins de deux ans</option>  
 <option value="5">Analyste depuis plus de deux ans mais moins de 4 ans</option>  
 <option value="6">Analyste au delà de 4 ans</option>  
              </select>
              <br>
            </td>
          </tr>
		  
		  
          <tr>
            <td class="formName" style="text-align: right;">Indemnité de résidence<br>
            </td>
            <td>
              <select required="required" name="IR">
                <option selected="selected" value="0">0</option>
                <option value="1%">1%</option>
                <option value="3%">3%</option>
              </select>
              <br>
            </td>
          </tr>
          <tr>
            <td colspan="2" rowspan="1" style="text-align: center; height: 11px;"><input
                formtarget="_parent"
                formmethod="post"
                value="Lancer la simulation"
                name="Calcul"
                type="submit"><br>
            </td>
            <td><br>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </body>
</html>
