<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My App</title>

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
                        <a class="nav-link" href="{{ route('home.test') }}"
                            @click.prevent="loadPage('home')">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about.test') }}"
                            @click.prevent="loadPage('about')">เกี่ยวกับเรา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.test') }}"
                            @click.prevent="loadPage('contact')">ติดต่อ</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- เนื้อหาหลัก -->
        <div class="container mt-3">
            <div id="content">
                <h3 v-if="loading">⏳ กำลังโหลดข้อมูล...</h3>
                <div v-html="pageContent"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
    <script>
        const app = Vue.createApp({
            data() {
                return {
                    loading: false,
                    pageContent: '',
                };
            },
            mounted() {
                const currentPath = window.location.pathname.replace('/', '') || 'home';
                this.loadPage(currentPath, false);

                window.addEventListener('popstate', (event) => {
                    if (event.state && event.state.page) {
                        this.loadPage(event.state.page, false);
                    }
                });
            },
            methods: {
                async loadPage(page, pushState = true) {
                    this.loading = true;
                    try {
                        const response = await fetch(`/${page}`);
                        if (!response.ok) throw new Error("ไม่สามารถโหลดเนื้อหาได้");

                        const html = await response.text();
                        this.pageContent = html;

                        if (pushState) {
                            history.pushState({
                                page
                            }, "", `/${page}`);
                        }
                    } catch (error) {
                        this.pageContent = `<h3 class="text-danger">❌ ไม่สามารถโหลดเนื้อหาได้</h3>`;
                        console.error("Error loading page:", error);
                    } finally {
                        this.loading = false;
                    }
                }
            }
        });

        app.mount('#app');
    </script>
</body>

</html>
