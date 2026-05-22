<!-- ========== Reels / Video Section Start ========== -->
<section class="py-16 bg-gradient-to-br from-[#4a5240] via-[#5c6b4e] to-[#3d4a35]">
  <div class="container">
    <div class="text-center mb-10">
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-3">Watch Our Art Come to Life</h2>
      <p class="text-green-200 text-lg max-w-xl mx-auto">See the craft and passion behind every handmade piece</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

      <?php
      $reels = [
        ['file' => 'reel-1.mp4', 'poster' => 'reel-1-thumb.jpg', 'caption' => 'Lippan Art Creation'],
        ['file' => 'reel-2.mp4', 'poster' => 'reel-2-thumb.jpg', 'caption' => 'Mandala Painting'],
        ['file' => 'reel-3.mp4', 'poster' => 'reel-3-thumb.jpg', 'caption' => 'Mirror Art Design'],
        ['file' => 'reel-4.mp4', 'poster' => 'reel-4-thumb.jpg', 'caption' => 'Wall Decor Crafting'],
        ['file' => 'reel-5.mp4', 'poster' => 'reel-5-thumb.jpg', 'caption' => 'Handcrafted Gift Making'],
        ['file' => 'reel-6.mp4', 'poster' => 'reel-6-thumb.jpg', 'caption' => 'Home Decor Showcase'],
      ];
      foreach ($reels as $reel):
      ?>
      <div class="group relative rounded-2xl overflow-hidden shadow-xl bg-black cursor-pointer transition-transform duration-300 hover:scale-[1.02]">
        <video
          class="w-full aspect-video object-cover"
          controls
          preload="none"
          poster="images/reels/<?= htmlspecialchars($reel['poster']) ?>"
        >
          <source src="images/reels/<?= htmlspecialchars($reel['file']) ?>" type="video/mp4">
          Your browser does not support the video tag.
        </video>
        <!-- Play overlay (shown before play) -->
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none group-has-[:playing]:opacity-0 transition-opacity">
        </div>
        <!-- Caption -->
        <div class="bg-gradient-to-t from-black/70 to-transparent absolute bottom-0 left-0 right-0 p-4 pointer-events-none">
          <p class="text-white font-semibold text-sm"><?= htmlspecialchars($reel['caption']) ?></p>
        </div>
      </div>
      <?php endforeach; ?>

    </div>

    <p class="text-center text-green-300 text-sm mt-8 opacity-70">
      Drop your video files into <code class="bg-black/30 px-2 py-0.5 rounded">images/reels/</code> as reel-1.mp4 … reel-6.mp4
    </p>
  </div>
</section>
<!-- ========== Reels / Video Section End ========== -->
