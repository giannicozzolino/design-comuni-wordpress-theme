<?php
global $posts, $the_query, $load_posts, $servizio, $load_card_type;

$max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 5;
$load_posts = 10;
$query = isset($_GET['search']) ? $_GET['search'] : null;
$args = array(
	's' => $query,
    'post_status' => 'publish',
	'posts_per_page' => $max_posts,
	'post_type'      => 'servizio',
	'orderby'        => 'post_title',
	'order'          => 'ASC'
);
$the_query = new WP_Query( $args );
$posts = $the_query->posts;

// Per selezionare i contenuti in evidenza tramite flag
// $post_types = dci_get_post_types_grouped('servizi');
// $servizi_evidenza = dci_get_highlighted_posts( $post_types, 10);

//Per selezionare i contenuti in evidenza tramite configurazione
$servizi_evidenza = dci_get_option('servizi_evidenziati','servizi');
?>

<div class="bg-grey-card py-3">
    <form role="search" id="search-form" method="get" class="search-form">
        <button type="submit" class="d-none"></button>
        <div class="container">
            <h2 class="title-xxlarge mb-4 mt-5 mb-lg-10">
                Esplora tutti i servizi
            </h2>
            <div class="cmp-input-search">
                <div class="form-group autocomplete-wrapper mb-2 mb-lg-4">
                    <div class="input-group">
                        <label for="autocomplete-autocomplete-three" class="visually-hidden">Cerca una parola chiave</label>
                        <input
                                type="search"
                                class="autocomplete form-control"
                                placeholder="Cerca una parola chiave"
                                id="autocomplete-two"
                                name="search"
                                value="<?php echo $query; ?>"
                                data-bs-autocomplete="[]"
                        />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="button-3">
                                Invio
                            </button>
                        </div>
                        <span class="autocomplete-icon" aria-hidden="true">
                            <svg class="icon icon-sm icon-primary" role="img" aria-labelledby="autocomplete-label">
                            <use href="#it-search"></use></svg>
                        </span>
                    </div>
                </div>
            </div>
            <p class="mb-4"><strong><?php echo $the_query->found_posts; ?> </strong>servizi trovati in ordine alfabetico</p>

            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div  class="row g-2" id="load-more">
		                <?php foreach ($posts as $post) {
				                $load_card_type = "servizio";
				                get_template_part("template-parts/servizio/cards-list");
		                } ?>
                    </div>
                </div>

	            <?php if (is_array($servizi_evidenza) && count($servizi_evidenza)) { ?>
                    <div class="col-lg-4 pt-30 pt-lg-5 ps-lg-5 order-first order-md-last">
                        <div class="link-list-wrap">
                            <h2 class="title-xsmall-semi-bold"><span>SERVIZI IN EVIDENZA</span></h2>
                            <ul class="link-list t-primary">
					            <?php
                                if ($servizi_evidenza) {
                                    foreach ($servizi_evidenza as $servizio_id) {
                                        $post = get_post($servizio_id);
                                        if ($post) {
                                        ?>
                                        <li class="mb-3 mt-3">
                                            <a class="list-item ps-0 title-medium" href="<?php echo get_permalink($post->ID); ?>">
                                                <span><?php echo $post->post_title?? "Servizio eliminato"; ?></span>
                                            </a>
                                        </li>
                                    <?php } }
                                } ?>
                            </ul>
                        </div>
                    </div>
	            <?php } ?>


            </div>
	        <?php get_template_part("template-parts/search/more-results"); ?>
        </div>
    </form>
</div>
<?php wp_reset_query(); ?>