<style>
  #myBreadCrumb {
    background-image: url('assets/images/3.webp');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  }
</style>

<section id="myBreadCrumb"
  class="flex flex-col items-center justify-center py-4 px-6 md:px-8 gap-2 min-h-[300px] h-[300px]">
  <h2 class="text-3xl md:text-4xl font-bold tracking-tight text-white ">
    <?php echo $breadTitle; ?>
  </h2>
  <div class="h-[5px] w-1/2 bg-white"></div>
  <p class="text-sm/6 font-medium text-white ">
    <?php echo $breadDesc; ?>
  </p>
</section>