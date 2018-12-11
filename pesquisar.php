<?php
  include("header.php");
  include("conectar.php");
?>
<div id="basic-form">
  <div class="row">
    <div class="col s12">
      <div class="card-panel">
        <form method="post" action="pessoas-encontradas.php">
          <h4 class="header2"><center>Pesquisar cliente</center></h4>
          <div class="row">
						<form class="col s11 offset-s1">
						  <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input id="nome" name="nome" type="text">
                  <label for="nome" class="center-align">Nome</label>
                </div>
                <button type="submit" class="btn black" name="pesquisar" value="submit">Pesquisar</button>
              </div>   
            </form>
          </div>
        </form>
      </div> 
    </div>
  </div>
</div>
<?php
  include("footer.php");  
?>  