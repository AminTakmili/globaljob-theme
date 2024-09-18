<!-- Search -->
<div class="widget search-bx">
    <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="input-group">
           <input type="search" name="s" class="form-control" placeholder="<?php esc_attr_e('Search Here ...', 'jobzilla'); ?>" required>
			<button type="submit" class="btn">
				<i class="feather-search"></i>
			</button>
        </div>
    </form>
</div>


