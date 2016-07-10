body {height:100%}

table.tabela-classificaco th {padding-right:2px;padding-left:2px;text-align:center;}
table.tabela-classificaco th.apostador-name-col {min-width:140px;}
table.tabela-classificaco tr td.apostador-name-col {padding-right:20px;text-align:right;}

table.tabela-classificaco tr td {padding-top:8px; padding-bottom:8px;text-align:center;border-right:1px dotted #E5E5E5;}
table.tabela-classificaco tr.odd {background-color: #fff;}
table.tabela-classificaco tr.even {background-color: #FCFCFC;}

table.tabela-apostas-podio-melhor-marcador{
	text-align:center;
	margin:10px;
	border-collapse:collapse;
}

table.tabela-apostas-podio-melhor-marcador tbody {
	border-style:none;
}

table.tabela-apostas-podio-melhor-marcador td {

}

table.tabela-apostas-podio-melhor-marcador td.label-cell {
	font-weight: bold;
	color:#6C8D72;
	padding-top:12px;;
}

/* Added to remove padding in small devices
   Don't waste space
*/
@media (max-width: 768px) {
  div.container {
	padding-right: 0px;
	padding-left: 0px;
	
    margin-left:0px;
    margin-right:0px;

 	width:100%;
  }
}



/* Side Navigation Menu 
// 
// COPIED FROM BOOTSTRAP DOC Website
*/
.bs-docs-sidenav {
  width: 228px;
  margin: 30px 0 0;
  padding: 0;
  background-color: #fff;
  -webkit-border-radius: 6px;
     -moz-border-radius: 6px;
          border-radius: 6px;
  -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.065);
     -moz-box-shadow: 0 1px 4px rgba(0,0,0,.065);
          box-shadow: 0 1px 4px rgba(0,0,0,.065);
}
.bs-docs-sidenav > li > a {
  display: block;
  width: 190px \9;
  margin: 0 0 -1px;
  padding: 8px 14px;
  border: 1px solid #e5e5e5;
}
.bs-docs-sidenav > li:first-child > a {
  -webkit-border-radius: 6px 6px 0 0;
     -moz-border-radius: 6px 6px 0 0;
          
  border-radius: 6px 6px 0 0;
}
.bs-docs-sidenav > li:last-child > a {
  -webkit-border-radius: 0 0 6px 6px;
     -moz-border-radius: 0 0 6px 6px;
          border-radius: 0 0 6px 6px;
}
.bs-docs-sidenav > .active > a {
  position: relative;
  z-index: 2;
  padding: 9px 15px;
  border: 0;
  text-shadow: 0 1px 0 rgba(0,0,0,.15);
  -webkit-box-shadow: inset 1px 0 0 rgba(0,0,0,.1), inset -1px 0 0 rgba(0,0,0,.1);
     -moz-box-shadow: inset 1px 0 0 rgba(0,0,0,.1), inset -1px 0 0 rgba(0,0,0,.1);
          box-shadow: inset 1px 0 0 rgba(0,0,0,.1), inset -1px 0 0 rgba(0,0,0,.1);
}
/* Chevrons */
.bs-docs-sidenav .icon-chevron-right {
  float: right;
  margin-top: 2px;
  margin-right: -6px;
  opacity: .25;
}
.bs-docs-sidenav > li > a:hover {
  background-color: #f5f5f5;
}
.bs-docs-sidenav a:hover .icon-chevron-right {
  opacity: .5;
}
.bs-docs-sidenav .active .icon-chevron-right,
.bs-docs-sidenav .active a:hover .icon-chevron-right {
  background-image: url(../img/glyphicons-halflings-white.png);
  opacity: 1;
}
.bs-docs-sidenav.affix {
  top: 0px;
}
.bs-docs-sidenav.affix-bottom {
  position: absolute;
  top: auto;
  bottom: 270px;
}

