<?php get_header(); ?>
<main class="topMain">
  <section class="topMv">
    <?php
    require_once 'templates/sectionTitle.php';
    $sectionTitle = new sectionTitle('メインタイトル', 'サブタイトル');
    $sectionTitle->render();
    ?>
  </section>
</main>
<?php get_footer(); ?>