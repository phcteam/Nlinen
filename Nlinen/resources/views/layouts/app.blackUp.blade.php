<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Application</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <!-- เมนูหลัก -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">My Application</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click.prevent="loadPage('home')">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click.prevent="loadPage('about')">เกี่ยวกับเรา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click.prevent="loadPage('contact')">ติดต่อ</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- เนื้อหาหลัก -->
        <div class="container mt-3">
            <div id="content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
    <script>
        const app = Vue.createApp({
            mounted() {
                // โหลดหน้าปัจจุบันจาก URL ถ้าเป็น path /home, /about, /contact
                const currentPath = window.location.pathname.replace('/', '');
                if (currentPath) {
                    this.loadPage(currentPath, false);
                } else {
                    this.loadPage('home', false); // โหลดหน้าแรก
                }

                // จัดการปุ่มย้อนกลับ (Back Button)
                window.addEventListener('popstate', (event) => {
                    if (event.state && event.state.page) {
                        this.loadPage(event.state.page, false);
                    }
                });
            },
            methods: {
                loadPage(page, pushState = true) {
                    fetch(`/${page}`) // เรียก route Laravel เพื่อโหลดเนื้อหา
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('content').innerHTML = html;

                            // เปลี่ยน URL แต่ไม่โหลดใหม่
                            if (pushState) {
                                history.pushState({ page }, "", `/${page}`);
                            }
                        })
                        .catch(error => console.error("Error loading page:", error));
                }
            }
        });

        app.mount('#app');
    </script>
</body>
</html>
