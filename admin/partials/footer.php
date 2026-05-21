            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('expanded');
        }

        function confirmDelete(message) {
            return confirm(message || 'Are you sure you want to delete this? This action cannot be undone.');
        }

        // Auto-hide flash messages
        document.addEventListener('DOMContentLoaded', function() {
            var alerts = document.querySelectorAll('.flash-message');
            alerts.forEach(function(el) {
                setTimeout(function() {
                    el.style.opacity = '0';
                    setTimeout(function() { el.remove(); }, 300);
                }, 4000);
            });
        });
    </script>
</body>
</html>
