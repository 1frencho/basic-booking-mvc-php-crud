<?php if (!empty($layoutData['error'])): ?>
  <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
    <p class="font-bold">Be Warned</p>
    <p><?= htmlspecialchars($layoutData['error']); ?></p>
  </div>
<?php endif; ?>