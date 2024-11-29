<?php
$title_head = 'RAPPORT D\'ACTIVITÉ';
include_once 'header.php';
$activite = get_activite();
?>

<p>Choisissez une option :</p>
<div class="container">
  <div class="row border w-50">
    <div class="col-4">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="option" id="option1" value="impr_hebdomadaire" checked>
        <label class="form-check-label" for="option1">
          Hebdomadaire
        </label>
      </div>
    </div>
    <div class="col-4">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="option" id="option2" value="impr_mensuel">
        <label class="form-check-label" for="option2">
          Mensuel
        </label>
      </div>
    </div>
    <div class="col-4">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="option" id="option3" value="impr_anuel">
        <label class="form-check-label" for="option3">
          Annuel
        </label>
      </div>
    </div>
  </div>
</div>

<div id="resultat"></div>

<script>
    const options = document.querySelectorAll('input[name="option"]');
    const resultat = document.getElementById('resultat');

    function afficherContenu() {
        const optionSelectionnee = document.querySelector('input[name="option"]:checked').value;

        fetch(`../include/${optionSelectionnee}.php`)
            .then(response => response.text())
            .then(data => {
                resultat.innerHTML = data;
            });
    }

    options.forEach(option => {
        option.addEventListener('change', afficherContenu);
    });
</script>

<?php
include_once 'footer.php';
?>