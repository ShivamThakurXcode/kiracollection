<?php
session_start();
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/includes/db.php';

$db = getDB();
$db->exec("
    CREATE TABLE IF NOT EXISTS `contact_messages` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `first_name` VARCHAR(100) NOT NULL,
        `last_name` VARCHAR(100) NOT NULL,
        `email` VARCHAR(255) NOT NULL,
        `phone` VARCHAR(50) DEFAULT NULL,
        `subject` VARCHAR(255) NOT NULL,
        `message` TEXT NOT NULL,
        `status` VARCHAR(30) NOT NULL DEFAULT 'new',
        `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
");

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM contact_messages WHERE id = ?");
    $stmt->execute([$id]);
    $deleted = true;
}

$messages = $db->query("SELECT id, first_name, last_name, email, phone, subject, message, status, created_at FROM contact_messages ORDER BY id DESC")->fetchAll();
$totalMessages = count($messages);
?>
<style>
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.modal-container {
    background: #fff;
    border-radius: 16px;
    max-width: 640px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 24px 48px rgba(0,0,0,0.2);
    animation: modalFadeIn 0.2s ease;
}
@keyframes modalFadeIn {
    from { opacity: 0; transform: scale(0.95) translateY(10px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}
.modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 24px;
    border-bottom: 1px solid #f4f6f8;
    background: #556b2f;
    border-radius: 16px 16px 0 0;
}
.modal-header h3 {
    font-family: 'Urbanist', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #fff;
    margin: 0;
}
.modal-close {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: none;
    background: rgba(255,255,255,0.15);
    color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    transition: background 0.2s;
}
.modal-close:hover { background: rgba(255,255,255,0.25); }
.modal-body {
    padding: 24px;
}
.modal-field {
    margin-bottom: 16px;
}
.modal-field:last-child { margin-bottom: 0; }
.modal-field label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #919eab;
    margin-bottom: 4px;
}
.modal-field p {
    font-size: 15px;
    color: #212529;
    line-height: 1.6;
    margin: 0;
    word-break: break-word;
}
.modal-field a {
    color: #556b2f;
    font-weight: 500;
}
.modal-field a:hover { color: #3d5a1f; }
.modal-field .badge {
    display: inline-block;
    padding: 3px 12px;
    border-radius: 60px;
    font-size: 11px;
    font-weight: 600;
}
.badge-new { background: #e8f5e8; color: #3d5a1f; }
.badge-read { background: #d3f3ff; color: #1890ff; }
</style>

<div class="dashboard">
  <div class="page-header">
    <div>
      <h2>Contact Messages</h2>
      <p>Messages submitted from the public contact form</p>
    </div>
    <div class="stat-card" style="padding: 16px 20px; min-width: 180px; margin: 0;">
      <div class="stat-info">
        <span class="stat-value"><?= $totalMessages ?></span>
        <span class="stat-label">Total Messages</span>
      </div>
    </div>
  </div>

  <?php if (isset($deleted)): ?>
    <div class="flash-message flash-success">Message deleted successfully.</div>
  <?php endif; ?>

  <div class="table-card">
    <div class="table-card-header">
      <h3>Inbox</h3>
      <span class="view-all"><?= $totalMessages ?> received</span>
    </div>

    <div class="table-responsive">
      <table class="data-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Subject</th>
            <th style="width:120px">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($messages)): ?>
            <tr>
              <td colspan="6" class="empty-row">No contact messages yet.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($messages as $message): ?>
              <tr>
                <td>#<?= $message['id'] ?></td>
                <td><?= htmlspecialchars($message['first_name'] . ' ' . $message['last_name']) ?></td>
                <td><a href="mailto:<?= htmlspecialchars($message['email']) ?>"
                    class="table-link"><?= htmlspecialchars($message['email']) ?></a></td>
                <td><?= htmlspecialchars($message['phone'] ?: '-') ?></td>
                <td><?= htmlspecialchars($message['subject']) ?></td>
                <td>
                  <div class="action-btns">
                    <button class="btn-action btn-view" onclick="openMessageModal(<?= $message['id'] ?>)" title="View Message">
                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                    <a href="?delete=<?= $message['id'] ?>" class="btn-action btn-delete" onclick="return confirmDelete('Delete message #<?= $message['id'] ?> from <?= htmlspecialchars(addslashes($message['first_name'] . ' ' . $message['last_name'])) ?>? This cannot be undone.')" title="Delete Message">✕</a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal-overlay" id="messageModal">
  <div class="modal-container">
    <div class="modal-header">
      <h3>Message Details</h3>
      <button class="modal-close" onclick="closeMessageModal()">✕</button>
    </div>
    <div class="modal-body" id="modalBody"></div>
  </div>
</div>

<script>
const messagesData = <?= json_encode($messages) ?>;

function openMessageModal(id) {
    const msg = messagesData.find(function(m) { return m.id == id; });
    if (!msg) return;
    const name = escapeHtml(msg.first_name + ' ' + msg.last_name);
    const email = escapeHtml(msg.email);
    const phone = msg.phone ? escapeHtml(msg.phone) : '-';
    const subject = escapeHtml(msg.subject);
    const message = escapeHtml(msg.message);
    const status = escapeHtml(msg.status);
    const date = escapeHtml(msg.created_at);
    const statusClass = status === 'new' ? 'badge-new' : 'badge-read';

    document.getElementById('modalBody').innerHTML =
        '<div class="modal-field">' +
            '<label>Name</label>' +
            '<p>' + name + '</p>' +
        '</div>' +
        '<div class="modal-field">' +
            '<label>Email</label>' +
            '<p><a href="mailto:' + email + '">' + email + '</a></p>' +
        '</div>' +
        '<div class="modal-field">' +
            '<label>Phone</label>' +
            '<p>' + phone + '</p>' +
        '</div>' +
        '<div class="modal-field">' +
            '<label>Subject</label>' +
            '<p>' + subject + '</p>' +
        '</div>' +
        '<div class="modal-field">' +
            '<label>Message</label>' +
            '<p style="white-space:pre-wrap">' + message + '</p>' +
        '</div>' +
        '<div class="modal-field">' +
            '<label>Status</label>' +
            '<p><span class="badge ' + statusClass + '">' + status + '</span></p>' +
        '</div>' +
        '<div class="modal-field">' +
            '<label>Received</label>' +
            '<p>' + date + '</p>' +
        '</div>';

    document.getElementById('messageModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeMessageModal() {
    document.getElementById('messageModal').style.display = 'none';
    document.body.style.overflow = '';
}

document.getElementById('messageModal').addEventListener('click', function(e) {
    if (e.target === this) closeMessageModal();
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeMessageModal();
});

function escapeHtml(str) {
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(str));
    return div.innerHTML;
}
</script>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
