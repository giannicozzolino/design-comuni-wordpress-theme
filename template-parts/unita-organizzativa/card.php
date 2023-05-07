<?php
global $uo_id, $with_border;
$ufficio = get_post( $uo_id );

$prefix = '_dci_unita_organizzativa_';
$competenze = dci_get_meta( 'competenze', $prefix, $uo_id );

$img = dci_get_meta( 'immagine', $prefix, $uo_id );
$contatti = dci_get_meta( 'contatti', $prefix, $uo_id );

$prefix = '_dci_punto_contatto_';
$indirizzi = array();
$telefoni = array();
$emails = array();
foreach ( $contatti ?? null as $punto_contatto_id ) {
	$voci = dci_get_meta( 'voci', $prefix, $punto_contatto_id );
	foreach ( $voci as $voce ) {
		if ( $voce[ $prefix . 'tipo_punto_contatto' ] == 'indirizzo' )
			array_push( $indirizzi, $voce[ $prefix . 'valore' ] );
		if ( $voce[ $prefix . 'tipo_punto_contatto' ] == 'email' )
			array_push( $emails, $voce[ $prefix . 'valore' ] );
		if ( $voce[ $prefix . 'tipo_punto_contatto' ] == 'telefono' )
			array_push( $telefoni, $voce[ $prefix . 'valore' ] );
	}
}
?>

<div class="card card-teaser shadow mt-3 rounded">
	<svg class="icon" aria-hidden="true">
		<use xlink:href="#it-pa"></use>
	</svg>
	<div class="card-body">
		<h3 class="card-title h5">
			<a href="<?php echo get_permalink( $ufficio->ID ); ?>" class="text-decoration-none">
				<?php echo $ufficio->post_title; ?>
			</a>
		</h3>
		<div class="card-text">
			<div class="mt-3">
				<?php if ( $competenze ) {
					echo '<p>' . $competenze . '</p>';
				} ?>
            </div>
            <p class="mt-2">
				<?php foreach ( $indirizzi as $indirizzo ) {
					echo $indirizzo . '</br>';
				} ?>
				<?php foreach ( $telefoni as $telefono ) { ?>
					Telefono: <a href="tel:<?= $telefono ?>" aria-label="telefona a <?= $telefono ?>"
						title="telefona a <?= $telefono ?>"><?= $telefono ?></a>
                </br>
				<?php } ?>
				<?php foreach ( $emails as $email ) { ?>
					Email: <a href="mailto:<?= $email ?>" aria-label="invia un'email a <?= $email ?>"
						title="invia un'email a <?= $email ?>"><?= $email ?></a>
                </br>
				<?php } ?>
                </p>
		</div>
	</div>
	<?php if ( $img ) { ?>
		<div class="avatar size-xl">
			<?php dci_get_img( $img ); ?>
		</div>
	<?php } ?>
</div>

<?php
$with_border = false;
?>