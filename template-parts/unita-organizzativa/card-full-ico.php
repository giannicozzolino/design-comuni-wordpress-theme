<?php
    global $post_id, $with_border;
    $ufficio = get_post( $post_id );

    $prefix = '_dci_unita_organizzativa_';
    $img = dci_get_meta('immagine', $prefix, $post_id);
    $punti_contatto = dci_get_meta('contatti', $prefix, $post_id);
    $competenze = dci_get_meta('competenze', $prefix, $post_id);
    $post_id = null;

    $prefix = '_dci_punto_contatto_';
    $contatti = array();
    foreach ($punti_contatto as $post_id) {
        $contatto = dci_get_full_punto_contatto($post_id);
        array_push($contatti, $contatto);
    }
    $other_contacts = array(
        'linkedin',
        'pec',
        'skype',
        'telegram',
        'twitter',
        'whatsapp'
    );
    
    if(!$with_border) {
?>

<div class="card card-teaser shadow mt-3 rounded">
    <svg class="icon">
        <use xlink:href="#it-pa"></use>
    </svg>
    <div class="card-body">
        <h3 class="card-title h5">
            <a class="text-decoration-none" href="<?php echo get_permalink($ufficio->ID); ?>">
                <?php echo $ufficio->post_title; ?>
            </a>
        </h5>
        <div class="card-text">
            <?php foreach ($contatti as $full_contatto) { ?>
                <div class="card-text">
                    <?php if ($competenze) {
                        echo '<p class="u-main-black">'.$competenze.'</p>';
                    } ?>
                    <?php if (is_array($full_contatto['indirizzo'] ?? null) && count($full_contatto['indirizzo'])) {
                        foreach ($full_contatto['indirizzo'] as $value) {
                            echo '<p class="u-main-black">' . $value . '</p>';
                        }
                    } ?>
                    <?php if (is_array($full_contatto['telefono'] ?? null) && count($full_contatto['telefono'])) {
                        foreach ($full_contatto['telefono'] as $value) {
                            echo '<p class="u-main-black">Telefono: <a href="tel:' . $value . '">' . $value . '</a></p>';
                        }
                    } ?>
                    <?php if (is_array($full_contatto['url'] ?? null) && count($full_contatto['url'])) {
                        foreach ($full_contatto['url'] as $value) { ?>
                            <p class="u-main-black">
                                <a target="_blank"
                                    aria-label="scopri di più su <?php echo $value; ?> - link esterno - apertura nuova scheda"
                                    title="vai sul sito <?php echo $value; ?>" href="<?php echo $value; ?>">
                                    <?php echo $value; ?>
                                </a>
                            </p>
                        <?php }
                    } ?>
                    <?php if (is_array($full_contatto['email'] ?? null) && count($full_contatto['email'])) {
                        foreach ($full_contatto['email'] as $value) {
                            echo '<p class="u-main-black">Email: '; ?>
                            <a target="_blank" aria-label="invia un'email a <?php echo $value; ?>"
                                title="invia un'email a <?php echo $value; ?>" href="mailto:<?php echo $value; ?>">
                                <?php echo $value; ?>
                            </a>
                            </p>
                        <?php }
                    } ?>
                    <?php if (is_array($full_contatto['pec'] ?? null) && count($full_contatto['pec'])) {
                        foreach ($full_contatto['pec'] as $value) {
                            echo '<p class="u-main-black">PEC: '; ?>
                            <a target="_blank" aria-label="invia una PEC a <?php echo $value; ?>"
                                title="invia una PEC a <?php echo $value; ?>" href="mailto:<?php echo $value; ?>">
                                <?php echo $value; ?>
                            </a>
                            </p>
                        <?php }
                    } ?>
                    <?php foreach ($other_contacts as $type) {
                        if (is_array($full_contatto[$type] ?? null) && count($full_contatto[$type])) {
                            foreach ($full_contatto[$type] as $value) {
                                echo '<p class="u-main-black">' . $type . ': ' . $value . '</p>';
                            }
                        }
                    } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } else { ?>
    <div class="card-wrapper rounded shadow-sm h-auto my-5">
        <div class="card card-teaser card-teaser-info rounded shadow-sm p-4">
            <svg class="icon">
                <use xlink:href="#it-pa"></use>
            </svg>
            <div class="card-body pe-3">
                <h3 class="card-title h5">
                    <a href="<?php echo get_permalink($ufficio->ID); ?>">
                        <?php echo $ufficio->post_title; ?>
                    </a>
                </h5>
                <div class="card-text">
                    <?php foreach ($contatti as $full_contatto) { ?>
                        <div class="card-text mb-3">
                            <?php if ( isset($full_contatto['indirizzo']) && is_array($full_contatto['indirizzo']) && count ($full_contatto['indirizzo']) ) {
                                foreach ($full_contatto['indirizzo'] as $value) {
                                    echo '<p>'.$value.'</p>';
                                } 
                            } ?>
                            <?php if ( isset($full_contatto['telefono']) && is_array($full_contatto['telefono']) && count ($full_contatto['telefono']) ) {
                                foreach ($full_contatto['telefono'] as $value) {
                                    echo '<p>T '.$value.'</p>';
                                }
                            } ?>
                            <?php if ( isset($full_contatto['url']) && is_array($full_contatto['url']) && count ($full_contatto['url']) ) {
                                foreach ($full_contatto['url'] as $value) { ?>
                                    <p>
                                        <a 
                                        target="_blank" 
                                        aria-label="scopri di più su <?php echo $value; ?> - link esterno - apertura nuova scheda"
                                        href="<?php echo $value; ?>">
                                            <?php echo $value; ?>
                                        </a>
                                    </p>
                            <?php }
                            } ?>
                            <?php if ( isset($full_contatto['email']) && is_array($full_contatto['email']) && count ($full_contatto['email']) ) {
                                foreach ($full_contatto['email'] as $value) { ?>
                                    <p>
                                        <a  
                                        target="_blank" 
                                        aria-label="invia un'email a <?php echo $value; ?>"
                                        href="mailto:<?php echo $value; ?>">
                                            <?php echo $value; ?>
                                        </a>
                                    </p>
                            <?php }
                            } ?>
                            <?php foreach ($other_contacts as $type) {
                                if ( isset($full_contatto[$type]) && is_array($full_contatto[$type]) && count ($full_contatto[$type]) ) {
                                    foreach ($full_contatto[$type] as $value) {
                                        echo '<p>'.$type.': '.$value.'</p>';
                                    }
                                } 
                            } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } 
$with_border = false;
?>
