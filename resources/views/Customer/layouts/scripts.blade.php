<script>
    const themeToggle   = document.getElementById('themeToggle');
    const sidebar       = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');

    themeToggle?.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        localStorage.setItem('theme', document.body.classList.contains('dark')?'dark':'light');
    });
    sidebarToggle?.addEventListener('click', toggleSidebar);
    function toggleSidebar(){ sidebar.classList.toggle('d-none'); }

    document.addEventListener('DOMContentLoaded', () => {
        if(localStorage.getItem('theme')==='dark'){ document.body.classList.add('dark'); }
    });
    </script>
