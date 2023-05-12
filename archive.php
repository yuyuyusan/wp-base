<?php get_header(); ?>
<main class="archiveMain">
  <section>
    <h1>
      <span class="jp"><?php the_archive_title(); ?></span>
    </h1>
    <div>
      <?php if (have_posts()) : ?>
        <dl>
          <?php while (have_posts()) : the_post(); ?>
            <div>
              <dt><?php echo get_the_date('Y.m.d'); ?></dt>
              <dd>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?>
                  <i class="fa-solid fa-angle-right"></i>
                </a>
              </dd>
            </div>
          <?php endwhile; ?>
        </dl>
        <?php the_posts_pagination(
          array(
            'prev_text' => '<i class="fa-solid fa-angle-left"></i>前のページ',
            'next_text' => '次のページ<i class="fa-solid fa-angle-right"></i>',
          )
        ); ?>
      <?php else : ?>
        <p>投稿がありません。</p>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>