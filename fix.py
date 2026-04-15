import re

with open('templates/base.html.twig', 'r', encoding='utf-8') as f:
    content = f.read()

header_replacement = '''    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-3">
                                <div class="logo">
                                    <a href="{{ path('app_home') }}">
                                        <img src="{{ asset('img/logo_lamma.png') }}" alt="LAMMA Logo" style="max-height: 50px;" onerror="this.outerHTML='<h2 style=\'color: white; font-family: Anton, sans-serif; margin: 0; position: relative; top: 10px;\'>LAMMA <span style=\'font-size:12px;color:#3b82f6;\'>EXPEDITION</span></h2>';">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ path('app_home') }}">Accueil</a></li>
                                            <li><a href="#">Événements <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="{{ path('app_evenement_index') }}">Événements</a></li>
                                                    <li><a href="{{ path('app_tiktok_search') }}">📱 TikTok Search</a></li>
                                                    <li><a href="{{ path('app_abonnement_plans') }}">📦 Nos Abonnements</a></li>
                                                    <li><a href="{{ path('app_abonnement_index') }}">Mes Abonnements</a></li>
                                                    <li><a href="{{ path('app_participation_index') }}">Participations</a></li>
                                                    <li><a href="{{ path('app_ticket_index') }}">Tickets</a></li>
                                                    <li><a href="{{ path('app_menu_planner_index') }}">📅 Menu Hebdomadaire</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Logistique <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="{{ path('app_restaurant_index') }}">Restaurants</a></li>
                                                    <li><a href="{{ path('app_menu_index') }}">Menus</a></li>
                                                    <li><a href="{{ path('app_repas_detaille_index') }}">Repas</a></li>
                                                    <li><a href="{{ path('app_ingredient_index') }}">Ingrédients</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="buy_tkt">
                                    <div class="d-none d-lg-flex justify-content-end align-items-center" style="gap: 15px;">
                                        {% if app.user %}
                                            {% if 'ROLE_ADMIN' in app.user.roles %}
                                                <a href="{{ path('app_admin_dashboard') }}" class="btn btn-sm" style="background: rgba(255,255,255,0.1); color: #fff; padding: 8px 16px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.2);">Dashboard Admin</a>
                                                <a href="{{ path('app_switch_role', {'role': 'user'}) }}" class="btn btn-sm" style="background: #10b981; color: #fff; padding: 8px 16px; border-radius: 6px;"><i class="fa fa-exchange"></i> Devenir User</a>
                                            {% else %}
                                                <a href="{{ path('app_cart_index') }}" class="btn btn-sm" style="background: #f97316; color: #fff; padding: 8px 16px; border-radius: 6px;"><i class="fa fa-shopping-cart"></i> Panier</a>
                                                <a href="{{ path('app_home') }}" class="btn btn-sm" style="background: rgba(255,255,255,0.1); color: #fff; padding: 8px 16px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.2);">Mon Espace</a>
                                                <a href="{{ path('app_switch_role', {'role': 'admin'}) }}" class="btn btn-sm" style="background: #f59e0b; color: #fff; padding: 8px 16px; border-radius: 6px;"><i class="fa fa-exchange"></i> Devenir Admin</a>
                                            {% endif %}
                                        {% else %}
                                            <a href="{{ path('app_switch_role', {'role': 'user'}) }}" class="btn btn-sm" style="background: #3b82f6; color: #fff; padding: 8px 16px; border-radius: 6px;">Démarrer Session</a>
                                        {% endif %}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->'''

new_content = re.sub(r'<!-- header-start -->.*?<!-- header-end -->', header_replacement, content, flags=re.DOTALL)
with open('templates/base.html.twig', 'w', encoding='utf-8') as f:
    f.write(new_content)
