<div class="wrap">

    <?php foreach ($notices as $notice): ?>

        <div class="nf-addon-notice">
            <p>
                <strong><?php echo $notice[ 'title' ]; ?></strong> requires an update. You have version <strong><?php echo $notice[ 'old_version' ]; ?></strong> installed. The current version is <strong><?php echo $notice[ 'new_version' ]; ?></strong>.
            </p>
        </div>

    <?php endforeach; ?>

    <?php foreach ($items as $item): ?>

    <div class="nf-extend nf-box">

        <img src="<?php echo $item['image']; ?>" />

        <h2><?php echo $item['title']; ?></h2>

        <div class="nf-extend-content">

            <p><?php echo $item['content']; ?></p>

            <div class="nf-extend-buttons">

                <?php if( ! empty( $item['docs'] ) ): ?>

                <a href="<?php echo $item['docs']; ?>" class="button-secondary nf-doc-button"><?php _e( 'Documentation', 'ninja-forms' ); ?></a>
                <?php else: ?>

                <p><a><?php _e( 'Documentation coming soon.', 'ninja-forms' ); ?></a></p>

                <?php endif; ?>

                <?php if( ! empty( $item['plugin'] ) && file_exists( WP_PLUGIN_DIR.'/'.$item['plugin'] ) ): ?>

                    <?php if( is_plugin_active( $item['plugin'] ) ): ?>

                    <span class="button-secondary nf-button"><?php _e( 'Active', 'ninja-forms' ); ?></span>

                    <?php elseif( is_plugin_inactive( $item['plugin'] ) ): ?>

                    <span class="button-secondary nf-button"><?php _e( 'Installed', 'ninja-forms' ); ?></span>

                    <?php else: ?>

                    <a href="<?php echo $item['link']; ?>" title="<?php echo $item['title']; ?>" class="button-primary nf-button"><?php _e( 'Learn More', 'ninja-forms' ); ?></a>

                    <?php endif; ?>

                <?php else: ?>

                <a href="<?php echo $item['link']; ?>" title="<?php echo $item['title']; ?>" class="button-primary nf-button"><?php _e( 'Learn More', 'ninja-forms' ); ?></a>

                <?php endif; ?>

            </div>

        </div>

    </div>

    <?php endforeach; ?>

</div>