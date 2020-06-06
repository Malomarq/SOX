<template>
    <div class="wrapper">

        <!-- SIDEBAR  -->

        <nav id="sidebar" class="bg-dark">
            <div class="sidebar-header">
                <h3>Panel Admin</h3>
                <strong>SX</strong>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a class="linkpanad" @click="showAndHide('Home')">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </li>
                <li>
                    <a class="linkpanad" @click="showAndHide('Account')">
                        <i class="fas fa-user-circle"></i>
                        {{account}}
                    </a>
                </li>
                <li>
                    <a class="linkpanad" @click="showAndHide('Users')">
                        <i class="fas fa-users"></i>
                        {{users}}
                    </a>
                </li>
                <li>
                    <a class="linkpanad" @click="showAndHide('Prods')">
                        <i class="fas fa-image"></i>
                        {{articles}}
                    </a>
                </li>
                <li>
                    <a class="linkpanad" @click="showAndHide('Ord')">
                        <i class="fas fa-copy"></i>
                        {{orders}}
                    </a>
                </li>
                <li>
                    <a class="linkpanad" @click="showAndHide('Con')">
                        <i class="fas fa-paper-plane"></i>
                        {{contact}}
                    </a>
                </li>
            </ul>
        </nav>

        <!-- END SIDEBAR  -->

        <!-- CONTENT  -->

        <div id="contentpanad" class="w-100 p-3 m-3">
            <a type="button" id="sidebarCollapse" class="infotag">
                <i :class="{'fas fa-toggle-on fa-3x':pushed,
                            'fas fa-toggle-on fa-3x fa-flip-horizontal':!pushed}"
                   @click="flipclick"/>
            </a>

            <home :showed="comps.showHome"></home>

            <account :idad="idad" :showed="comps.showAccount"></account>

            <users :showed="comps.showUsers"></users>

            <articles :showed="comps.showProds"></articles>

            <orders :showed="comps.showOrd"></orders>

            <contacts :showed="comps.showCon"></contacts>

        </div>

        <!-- END CONTENT  -->

    </div>

</template>

<script>

    import PanAdAccount from "./PanAdAccount";
    import PanAdArticles from "./PanAdArticles";
    import PanAdCon from "./PanAdCon";
    import PanAdHome from "./PanAdHome";
    import PanAdOrd from "./PanAdOrd";
    import PanAdUsers from "./PanAdUsers";

    export default {
        components: {
            PanAdAccount, PanAdArticles, PanAdCon, PanAdHome, PanAdOrd, PanAdUsers
        },

        props: {
            idad: '',
            account: '',
            users: '',
            articles: '',
            orders: '',
            contact: '',
        },

        data() {
            return {
                pushed: true,
                comps: {
                    showHome: false,
                    showAccount: false,
                    showUsers: false,
                    showProds: true,
                    showOrd: false,
                    showCon: false,
                },
            }
        },

        mounted() {

            $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                    $(this).toggleClass('active');
                });
            });
        },

        methods: {
            flipclick() {
                (this.pushed) ? this.pushed = false : this.pushed = true;
            },

            showAndHide: function (comp) {
                var i;
                for (i in this.comps) {
                    this.comps[i] = false;
                }

                switch (comp) {
                    case 'Home':
                        this.comps.showHome = true;
                        break;
                    case 'Account':
                        this.comps.showAccount = true;
                        break;
                    case 'Users':
                        this.comps.showUsers = true;
                        break;
                    case 'Prods':
                        this.comps.showProds = true;
                        break;
                    case 'Ord':
                        this.comps.showOrd = true;
                        break;
                    case 'Con':
                        this.comps.showCon = true;
                        break;
                }
            },

        }
    }
</script>

<style scoped>

    /* CUSTOM MEDIAQUERIES */

    @media (max-width: 768px) {
        #sidebar {
            min-width: 80px;
            max-width: 80px;
            text-align: center;
            margin-left: -80px !important;
        }

        #sidebar.active {
            margin-left: 0 !important;
        }

        #sidebar .sidebar-header h3 {
            display: none;
        }

        #sidebar .sidebar-header strong {
            display: block;
        }

        #sidebar ul li a {
            padding: 20px 10px;
        }

        #sidebar ul li a span {
            font-size: 0.85em;
        }

        #sidebar ul li a i {
            margin-right: 0;
            display: block;
        }

        #sidebar ul ul a {
            padding: 10px !important;
        }

        #sidebar ul li a i {
            font-size: 1.3em;
        }

        #sidebar {
            margin-left: 0;
        }

        #sidebarCollapse span {
            display: none;
        }
    }

</style>
