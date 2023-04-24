<?php
global $post, $hide_categories;

$prefix      = '_dci_servizio_';
$tipo        = get_the_terms( $post->ID, 'categorie_servizio' )[0];
$description = dci_get_meta( 'descrizione_breve', $prefix, $post->ID );
?>



<div class="cmp-card-latest-messages mb-2" data-bs-toggle="modal" data-bs-target="#" id="">
    <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
        <?php if (!$hide_categories) { ?>
        <span class="visually-hidden">Categoria: </span>
        <div class="card-header border-0 p-0">
            <a class="text-decoration-none title-xsmall-bold mb-2 category text-uppercase" href="<?php echo get_term_link( $tipo->term_id ); ?>"><?php echo strtoupper( $tipo->name ); ?></a>
        </div>
        <?php } ?>
        <div class="card-body p-0 my-2">
            <h3 class="green-title-big t-primary mb-8"><a href="<?php echo get_permalink( $post->ID ); ?>" class="text-decoration-none" data-element="service-link" data-focus-mouse="false"><?php echo get_the_title( $post->ID ); ?></a></h3>
            <p class="text-paragraph">
	            <?php echo $description; ?>
            </p>
        </div>
    </div>
</div>
