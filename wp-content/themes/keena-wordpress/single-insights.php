<?php
	get_header();

    while ( have_posts() ) : the_post(); 
    $title = get_the_title();
    $perm = get_the_permalink();
    if (have_rows('insight')) :
        while (have_rows('insight')) : the_row();
        // Obtain the media attachment link
            $media = get_sub_field('insight_media');
            $url = $media['url'];
            $link_url = get_sub_field('insight_link');
            if ($media && $link_url) {
                $url = $media['url'];
            } elseif ($media && !$link_url) {
                $url = $media['url'];
            } elseif ($link_url && !$media) {
                $url = $link_url;
            } else {
                $url = $media['url'];
            }

        endwhile;
    endif;

    $visible = 'true';
    if (!$url) {
        $visible = 'false';
    }
    
?>
<div class="single-insight pt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="insight-breadcrumb-download">
                    <div class="single-insight-breadcrumb">
                        <p id="breadcrumbs"><a href="/">Home</a> <span class="breadcrumbs-separator">›</span>
                            <a href="/about-us">About</a> <span class="breadcrumbs-separator">›</span>
                            <a href="/keena-insights">Insights</a> <span class="breadcrumbs-separator">›</span>
                            <a href="<?php echo $perm;?>"><?php echo $title;?></a> <span class="breadcrumbs-separator">
                        </p>
                    </div>
                    <div class="single-insight-download-cta visible-'.$visible.'">
                        <a href="<?php echo $url;?>" target="_blank"
                            class="btn btn-secondary dl-push download-item">Download
                            Case Study </a>
                    </div>
                </div>
            </div>
            <hr />
        </div>
    </div>
</div>
<?php
    binarym_block_builder();
            ?>

<?php endwhile; ?>

<?php
	get_footer();