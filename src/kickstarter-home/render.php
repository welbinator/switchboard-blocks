<?php
/**
 * Render callback for the Kickstarter Promo block.
 */

namespace GLD\Blocks;

function render_kickstarter_promo( $attributes ) {
	$heading      = esc_html( $attributes['heading'] ?? '' );
	$description  = esc_html( $attributes['description'] ?? '' );
	$note         = esc_html( $attributes['note'] ?? '' );
	$main_image   = esc_url( $attributes['mainImage'] ?? '' );
	$bottom_images = $attributes['bottomImages'] ?? [];

	ob_start();
	?>
	<div class="kickstarter-wrapper text-white flex">
		
			<div class="left-column w-[18%]">
                <img
					alt="Static side image"
					src="<?php echo esc_url( plugins_url( 'assets/images/left-column.png', SWITCHBOARD_BLOCKS_PLUGIN_FILE ) ); ?>"
					class="object-cover h-full"
				/>
			</div>
				
			<div class="p-8 right-column">
				<div class="flex flex-col">
					<div class="relative flex items-center mb-16 pt-8 hero-wrapper">
						<div class="text-center md:text-right pr-4 md:pr-12 rotate-[-6deg] hero-left">
							<h1 class="text-6xl mb-4 kickstarter-heading"><?php echo $heading; ?></h1>
							<p class="text-4xl mb-6 kickstarter-subheading"><?php echo nl2br( $description ); ?></p>
							<p class="text-3xl mb-6 kickstarter-link text-[#292644]">(<a class="text-[#292644] no-underline" href="https://<?php echo $note; ?>"><?php echo $note; ?></a>)</p>
							<img class="ml-auto desktop" src="<?php echo esc_url( plugins_url( 'assets/images/arrow-desktop.png', SWITCHBOARD_BLOCKS_PLUGIN_FILE ) ); ?>">
							<img class="m-auto mobile" src="<?php echo esc_url( plugins_url( 'assets/images/arrow-mobile.png', SWITCHBOARD_BLOCKS_PLUGIN_FILE ) ); ?>">
						</div>
						<div class="mt-8 md:mt-0 text-center hero-right">
							<?php if ( $main_image ) : ?>
								<img src="<?php echo $main_image; ?>" alt="Main" class="mx-auto w-full max-w-[37rem]" />
							<?php endif; ?>
						</div>
					</div>
					<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
						<?php foreach ( $bottom_images as $img ) : ?>
							
								<div class="rounded h-[25rem] w-[25rem]">
									<?php if ( $img ) : ?>
										<img src="<?php echo esc_url( $img ); ?>" alt="" class="w-full h-full object-cover" />
									<?php endif; ?>
									
								</div>
							
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		
	</div>
	<?php
	return ob_get_clean();
}
