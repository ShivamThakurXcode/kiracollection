<!-- ========== Reels / Video Section Start ========== -->
<section class="py-16 bg-gradient-to-br from-[#4a5240] via-[#5c6b4e] to-[#3d4a35]">
  <div class="container">
    <div class="text-center mb-10">
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-3">Watch Our Art Come to Life</h2>
      <p class="text-green-200 text-lg max-w-xl mx-auto">See the craft and passion behind every handmade piece</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

      <?php
      $reelFiles = glob(__DIR__ . '/../images/reels/*.mp4') ?: [];
      natsort($reelFiles);
      $captionMap = [
        'reel-1.mp4' => 'Lippan Art Creation',
        'reel-2.mp4' => 'Mandala Painting',
        'reel-3.mp4' => 'Mirror Art Design',
      ];
      $reels = array_map(function ($filePath) use ($captionMap) {
        $fileName = basename($filePath);
        return [
          'file' => $fileName,
          'caption' => $captionMap[$fileName] ?? pathinfo($fileName, PATHINFO_FILENAME),
        ];
      }, array_values($reelFiles));

      if (empty($reels)):
      ?>
      <div class="col-span-full rounded-2xl border border-white/15 bg-black/20 p-8 text-center text-white/80">
        No reel videos found in images/reels/.
      </div>
      <?php else: ?>
      <?php foreach ($reels as $reel): ?>
      <div class="group relative overflow-hidden rounded-2xl shadow-xl bg-black cursor-pointer transition-transform duration-300 hover:scale-[1.02]">
        <video
          class="w-full aspect-video object-cover bg-black"
          controls
          preload="metadata"
          playsinline
          muted
          loop
        >
          <source src="images/reels/<?= htmlspecialchars($reel['file']) ?>" type="video/mp4">
          Your browser does not support the video tag.
        </video>
        <!-- Caption -->
        <div class="bg-gradient-to-t from-black/70 to-transparent absolute bottom-0 left-0 right-0 p-4 pointer-events-none">
          <p class="text-white font-semibold text-sm"><?= htmlspecialchars($reel['caption']) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
      <?php endif; ?>

    </div>

    <p class="text-center text-green-300 text-sm mt-8 opacity-70">
      Drop your video files into <code class="bg-black/30 px-2 py-0.5 rounded">images/reels/</code> and they will appear here automatically.
    </p>
  </div>
</section>
<!-- ========== Reels / Video Section End ========== -->
