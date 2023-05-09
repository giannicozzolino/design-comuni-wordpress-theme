<?php
global $post_id, $with_contacts, $with_all_contacts;
$prefix = '_dci_punto_contatto_';
$voci = dci_get_meta( 'voci', $prefix, $post_id ) ?? null;

$indirizzi = array();
$emails = array();
$telefoni = array();
$altri_contatti = array();
if ($voci) {
	foreach ( $voci as $voce ) {
		if ( $voce[ $prefix . 'tipo_punto_contatto' ] == 'indirizzo' )
			array_push( $indirizzi, $voce[ $prefix . 'valore' ] );
		elseif ( $voce[ $prefix . 'tipo_punto_contatto' ] == 'email' )
			array_push( $emails, $voce[ $prefix . 'valore' ] );
		elseif ( $voce[ $prefix . 'tipo_punto_contatto' ] == 'telefono' )
			array_push( $telefoni, $voce[ $prefix . 'valore' ] );
		else
			array_push( $altri_contatti, $voce );
	}
}
?>

<div class="card card-teaser shadow mt-3 rounded">
	<svg class="icon" aria-hidden="true">
		<use xlink:href="#it-telephone"></use>
	</svg>
	<div class="card-body">
		<h3 class="card-title h5">
			<a href="<?php echo get_permalink( $post_id ); ?>" class="text-decoration-none">
				<?php echo get_the_title( $post_id ); ?>
			</a>
		</h3>
		<div class="card-text">
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
				<?php if ( $with_all_contacts ?? false ) { ?>
					<?php foreach ( $altri_contatti as $altro ) { ?>
						<?php echo ucfirst( $altro[ $prefix . 'tipo_punto_contatto' ] ) . ": " . $altro[ $prefix . 'valore' ]; ?>
						</br>
					<?php } ?>
				<?php } ?>
			</p>
		</div>
	</div>
	<?php if ( $img ?? null ) { ?>
		<div class="avatar size-xl">
			<?php dci_get_img( $img ); ?>
		</div>
	<?php } ?>
</div>

<?php
$with_border = false;
$with_contacts = false;
$with_all_contacts = false;
?>