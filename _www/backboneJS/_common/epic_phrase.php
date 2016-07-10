<?php
global $database, $user_id,$group_id;

//
// --  SAVE epic phrase changes
//	
if (isset($_POST['phrase']))
{	
	require_once __DIR__.'/log_in_check.php';
	require_once __DIR__.'/database_access.php';


	$database->prepare("REPLACE INTO epic_phrase (phrase, user_id) VALUES (?,?) ")->execute(array($_POST['phrase'],$user_id));
	die();
}

//
// -- LOAD current epic phrase and author
//
	$query = "SELECT a.phrase, b.Name user_name FROM epic_phrase a ";
	$query .= "INNER JOIN users b ON a.user_id = b.id ";
	$query .= "WHERE a.user_id = (SELECT user_id FROM ranking WHERE Group_id = $group_id ORDER BY points DESC, bulls_eye_bets DESC LIMIT 1)";
	$epic_phrase_for_current_group = $database->query($query)->fetch(PDO::FETCH_ASSOC);

?>

<?php 
	$epic_phrase_for_current_user = $database->query("SELECT phrase FROM epic_phrase WHERE user_id = ".$user_id)->fetch(PDO::FETCH_ASSOC);
	$epic_phrase_for_current_user = isset($epic_phrase_for_current_user['phrase'])?$epic_phrase_for_current_user['phrase']:'';
?>

<?php if ($epic_phrase_for_current_user == "") : ?>
	<div style="text-align:center">
		<a href="javascript:change_epic_phrase()">Criar a minha frase épica</a>
	</div>
<?php endif; ?>

<div class="text-center;" >
	<blockquote style="cursor:pointer" title="Mudar a minha frase épica" 
		onclick="change_epic_phrase()">
		<p class="h3"><?php echo (isset($epic_phrase_for_current_group['phrase'])?$epic_phrase_for_current_group['phrase']: "Porque entre duas minis... vem sempre uma aposta. "); ?></p>
		<footer><?php echo (isset($epic_phrase_for_current_group['user_name'])?$epic_phrase_for_current_group['user_name']:"ENVMA"); ?></footer>
	</blockquote>
</div>

<script>
function change_epic_phrase(){

	new_phrase = prompt('Nova frase?','<?php echo str_replace(array("'",'"'), array("\\'",""), $epic_phrase_for_current_user); ?>');
	if (new_phrase === null) return;
	$.ajax({url:"/_common/epic_phrase.php",method:"POST",
	data:{"phrase": new_phrase},
	success: function(){alert("Frase épica alterada!");},
	error: function(){alert("Oops. Alguma coisa correu mal."); }
	});
	
}
</script>