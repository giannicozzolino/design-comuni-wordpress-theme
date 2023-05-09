<?php
/**
 * Documento pubblico template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */

global $inline;

get_header();
?>

<main>
	<?php
	while ( have_posts() ) :
		the_post();
		$user_can_view_post = dci_members_can_user_view_post( get_current_user_id(), $post->ID );

		$prefix = '_dci_documento_pubblico_';
		$identificativo = dci_get_meta( "identificativo", $prefix, $post->ID );
		$numero_protocollo = dci_get_meta( "numero_protocollo", $prefix, $post->ID );
		$data_protocollo = dci_get_meta( "data_protocollo", $prefix, $post->ID );
		$tipo_documento = wp_get_post_terms( $post->ID, array( 'tipi_documento', 'tipi_doc_albo_pretorio' ) );
		$descrizione_breve = dci_get_meta( "descrizione_breve", $prefix, $post->ID );
		$url_documento = dci_get_meta( "url_documento", $prefix, $post->ID );
		$file_documento = dci_get_meta( "file_documento", $prefix, $post->ID );
		$descrizione = dci_get_wysiwyg_field( "descrizione_estesa", $prefix, $post->ID );
		$ufficio_responsabile = dci_get_meta( "ufficio_responsabile", $prefix, $post->ID );
		$autori = dci_get_wysiwyg_field( "autori", $prefix, $post->ID );
		$formati = dci_get_wysiwyg_field( "formati", $prefix, $post->ID );
		$licenza = wp_get_post_terms( $post->ID, array( 'licenze' ) );
		$servizi = dci_get_meta( "servizi", $prefix, $post->ID );
		$dataset = dci_get_meta( "dataset", $prefix, $post->ID );
		$documenti_collegati = dci_get_meta( "documenti_collegati", $prefix, $post->ID );
		$more_info = dci_get_wysiwyg_field( "ulteriori_informazioni" );
		$riferimenti_normativi = dci_get_wysiwyg_field( "riferimenti_normativi" );
		?>
			<div class="container" id="main-container">
				<div class="row">
					<div class="col px-lg-4">
						<?php get_template_part( "template-parts/common/breadcrumb" ); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8 px-lg-4 py-lg-2">
						<h1>
							<?php the_title(); ?>
						</h1>
						<h3 class="visually-hidden">Dettagli del documento</h3>
						<p>
							<?php echo $descrizione_breve; ?>
						</p>
					</div>
					<div class="col-lg-3 offset-lg-1">
						<?php
						$inline = true;
						get_template_part( 'template-parts/single/actions' );
						?>
					</div>
				</div>
			</div>
			<?php get_template_part( 'template-parts/single/image-large' ); ?>
			<div class="container">
				<div class="row border-top border-light row-column-border row-column-menu-left">
					<aside class="col-lg-3">
						<div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
							<nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="Indice della pagina"
								data-bs-navscroll>
								<div class="navbar-custom" id="navbarNavProgress">
									<div class="menu-wrapper">
										<div class="link-list-wrapper">
											<div class="accordion">
												<div class="accordion-item">
													<span class="accordion-header" id="accordion-title-one">
														<button class="accordion-button pb-10 px-3 text-uppercase" type="button"
															aria-controls="collapse-one" aria-expanded="true"
															data-bs-toggle="collapse" data-bs-target="#collapse-one">INDICE
															DELLA PAGINA
															<svg class="icon icon-sm icon-primary align-top">
																<use xlink:href="#it-expand"></use>
															</svg>
														</button>
													</span>
													<div class="progress">
														<div class="progress-bar it-navscroll-progressbar" role="progressbar"
															aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
													<div id="collapse-one" class="accordion-collapse collapse show"
														role="region" aria-labelledby="accordion-title-one">
														<div class="accordion-body">
															<ul class="link-list" data-element="page-index">
																<li class="nav-item">
																	<a class="nav-link" href="#descrizione">
																		<span class="title-medium">Descrizione</span>
																	</a>
																</li>
																<?php if ( $url_documento || $file_documento ) { ?>
																		<li class="nav-item">
																			<a class="nav-link" href="#documenti">
																				<span class="title-medium">Documenti</span>
																			</a>
																		</li>
																<?php } ?>
																<?php if ( is_array( $documenti_collegati ) && count( $documenti_collegati ) ) { ?>
																		<li class="nav-item">
																			<a class="nav-link" href="#documenti_collegati">
																				<span class="title-medium">Documenti correlati</span>
																			</a>
																		</li>
																<?php } ?>
																<li class="nav-item">
																	<a class="nav-link" href="#ufficio_responsabile">
																		<span class="title-medium">Ufficio responsabile</span>
																	</a>
																</li>
																<?php if ( $servizi && count( $servizi ) ) { ?>
																		<li class="nav-item">
																			<a class="nav-link" href="#servizi">
																				<span class="title-medium">Servizi</span>
																			</a>
																		</li>
																<?php } ?>
																<?php if ( $dataset && count( $dataset ) ) { ?>
																		<li class="nav-item">
																			<a class="nav-link" href="#dataset">
																				<span class="title-medium">Dataset</span>
																			</a>
																		</li>
																<?php } ?>
																<?php if ( $more_info ) { ?>
																		<li class="nav-item">
																			<a class="nav-link" href="#ulteriori_informazioni">
																				<span class="title-medium">Ulteriori informazioni</span>
																			</a>
																		</li>
																<?php } ?>
																<?php if ( $riferimenti_normativi ) { ?>
																		<li class="nav-item">
																			<a class="nav-link" href="#riferimenti_normativi">
																				<span class="title-medium">Riferimenti normativi</span>
																			</a>
																		</li>
																<?php } ?>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</nav>
						</div>
					</aside>
					<article class="col-lg-9 it-page-sections-container border-light">
						<section class="it-page-section mb-5" id="descrizione" >
							<h2 class="mb-3">Descrizione</h2>
							<div class="richtext-wrapper lora">
								<?php echo $descrizione; ?>
								<div class="table-responsive">
									<table class="table">
										<tbody>
											<tr>
												<td><b>Tipo documento</b></td>
												<td>
													<?php foreach ( $tipo_documento as $tipo ) {
														$url = get_term_link( $tipo->slug, $tipo->taxonomy );
														?>
															<a class="text-decoration-none" href="<?= $url ?>"
																aria-label="Vai all'archivio <?php echo $tipo->name; ?>"
																title="Vai all'archivio <?php echo $tipo->name; ?>">
																<?php echo $tipo->name; ?>
															</a>,
													<?php } ?>
												</td>
											</tr>
											<tr>
												<td><b>Numero e data</b></td>
												<td>n.
													<?= $numero_protocollo ?> del
													<?= $data_protocollo ?>
												</td>
											</tr>
											<tr>
												<td><b>Data di pubblicazione</b></td>
												<td>
													<?= the_date() ?>
												</td>
											</tr>
											<tr>
												<td><b>Oggetto</b></td>
												<td>
													<?= $descrizione_breve ?>
												</td>
											</tr>
											<?php if ( $autori ) { ?>
													<tr>
														<td><b>Autori</b></td>
														<td>
															<?= $autori ?>
														</td>
													</tr>
											<?php } ?>
											<?php if ( $formati ) { ?>
													<tr>
														<td><b>Formati</b></td>
														<td>
															<?= $formati ?>
														</td>
													</tr>
											<?php } ?>
											<?php if ( $licenza ) { ?>
													<tr>
														<td><b>Licenze</b></td>
														<td>
															<?php foreach ( $licenza as $tipo ) {
																echo $tipo->name;
															} ?>
														</td>
													</tr>
											<?php } ?>

										</tbody>
									</table>
								</div>
							</div>
													</section>
						<?php if ( $url_documento || $file_documento ) { ?>
								<section class="it-page-section mb-5" id="documenti">
								<h2 class="mb-3">Documenti</h2>
									<div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
										<?php
										if ( $file_documento ) {
											$documento_id = attachment_url_to_postid( $file_documento );
											$documento = get_post( $documento_id );
											?>
												<div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
													<svg class="icon" aria-hidden="true">
														<use xlink:href="#it-clip"></use>
													</svg>
													<div class="card-body">
														<h5 class="card-title">
															<a class="text-decoration-none" href="<?php echo $file_documento; ?>"
																aria-label="Scarica il documento <?php echo $documento->post_title; ?>"
																title="Scarica il documento <?php echo $documento->post_title; ?>">
																<?php echo $documento->post_title; ?>
															</a>
														</h5>
													</div>
												</div>
										<?php }
										if ( $url_documento ) { ?>
												<div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
													<svg class="icon" aria-hidden="true">
														<use xlink:href="#it-clip"></use>
													</svg>
													<div class="card-body">
														<h5 class="card-title">
															<a class="text-decoration-none" href="<?php echo $url_documento; ?>"
																aria-label="Scarica il documento" title="Scarica il documento">
																Scarica il documento
															</a>
														</h5>
													</div>
												</div>
										<?php } ?>
									</div>
										</section>
						<?php } ?>
						<?php if ( is_array( $documenti_collegati ) && count( $documenti_collegati ) ) { ?>
								<section class="it-page-section mb-5" id="documenti_collegati">
									<h2 class="mb-3">Documenti correlati</h2>
									<div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
										<?php foreach ( $documenti_collegati as $all_url ) {
											$all_id = attachment_url_to_postid( $all_url );
											$documento = get_post( $all_id );
											$with_border = true;
											get_template_part( "template-parts/documento/card" );
										} ?>
									</div>
								</section>
						<?php } ?>
						<section class="it-page-section mb-5" id="ufficio_responsabile">
						<h2 class="mb-3">Ufficio responsabile</h2>
							<div class="row">
								<div class="col-12 col-sm-8">
									<?php foreach ( $ufficio_responsabile as $post_id ) {
										$with_border = true;
										get_template_part( "template-parts/unita-organizzativa/card" );
									} ?>
								</div>
								<!-- <div class="col-12 col-sm-4">
								<h6><small>Persone</small></h6>
								<?php get_template_part( "template-parts/single/persone" ); ?>
							</div> -->
							</div>
						</section>
						<?php if ( $servizi && is_array( $servizi ) && count( $servizi ) > 0 ) { ?>
								<section class="it-page-section mb-5" id="servizi" >
								<h2 class="mb-3">Servizi</h2>
									<div class="row">
										<div class="col-12 col-sm-8">
											<?php foreach ( $servizi as $servizio_id ) {
												$servizio = get_post( $servizio_id );
												$with_border = true;
												get_template_part( "template-parts/servizio/card" );
											} ?>
										</div>
									</div>
								</section>
						<?php } ?>
						<?php if ( $dataset && is_array( $dataset ) && count( $dataset ) > 0 ) { ?>
								<section class="it-page-section mb-5" id="dataset">
								<h2 class="mb-3">Dataset</h2>
									<div class="row">
										<div class="col-12 col-sm-8">
											<?php foreach ( $dataset as $dataset_id ) {
												$documento = get_post( $dataset_id );
												$with_border = true;
												get_template_part( "template-parts/documento/card" );
											} ?>
										</div>
									</div>
								</section>
						<?php } ?>
						<?php if ( $more_info ) { ?>
								<section class="it-page-section mb-5" id="ulteriori_informazioni">
								<h2 class="mb-3">Ulteriori informazioni</h2>
									<div class="richtext-wrapper lora">
										<?php echo $more_info ?>
									</div>
								</section>
						<?php } ?>
						<?php if ( $riferimenti_normativi ) { ?>
								<section class="it-page-section mb-5" id="riferimenti_normativi">
								<h2 class="mb-3">Riferimenti normativi</h2>
									<div class="richtext-wrapper lora">
										<?php echo $riferimenti_normativi ?>
									</div>
								</section>
						<?php } ?>
                        
                        <?php get_template_part( "template-parts/single/page_bottom" ); ?>
					</article>
				</div>
			</div>


			<?php
	endwhile; // End of the loop.
	?>
</main>
<script>
	const descText = document.querySelector('#descrizione')?.closest('article').innerText;
	const wordsNumber = descText.split(' ').length
	document.querySelector('#readingTime').innerHTML = `${Math.ceil(wordsNumber / 200)} min`;
</script>
<?php
get_footer();