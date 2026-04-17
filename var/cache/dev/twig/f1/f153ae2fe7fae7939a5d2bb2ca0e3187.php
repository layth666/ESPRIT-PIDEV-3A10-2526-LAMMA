<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* admin/base_admin.html.twig */
class __TwigTemplate_010f481e5ac87aabcc438f3e167c7de4 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'extra_styles' => [$this, 'block_extra_styles'],
            'page_title' => [$this, 'block_page_title'],
            'breadcrumb' => [$this, 'block_breadcrumb'],
            'content' => [$this, 'block_content'],
            'extra_scripts' => [$this, 'block_extra_scripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/base_admin.html.twig"));

        // line 11
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta charset=\"UTF-8\"/>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
  <title>LAMMA Admin — ";
        // line 16
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
  <link href=\"https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap\" rel=\"stylesheet\"/>
  <style>
    :root {
      --red:     #e8392c;
      --teal:    #2ecfb8;
      --yellow:  #f5c842;
      --dark:    #080809;
      --surface: #0f0f11;
      --card:    #141416;
      --card2:   #1a1a1d;
      --line:    rgba(255,255,255,0.07);
      --muted:   rgba(255,255,255,0.38);
      --soft:    rgba(255,255,255,0.65);
      --white:   #ffffff;
      --sidebar-w: 240px;
    }
    *, *::before, *::after { box-sizing: border-box; margin:0; padding:0; }
    html, body { height:100%; background:var(--dark); color:var(--white); font-family:'DM Sans',sans-serif; overflow:hidden; }

    /* ══ LAYOUT ══ */
    .admin-shell { display:flex; height:100vh; }

    /* ══ SIDEBAR ══ */
    .sidebar {
      width: var(--sidebar-w);
      background: var(--surface);
      border-right: 1px solid var(--line);
      display: flex; flex-direction: column;
      flex-shrink: 0;
      position: relative; z-index: 10;
    }
    .sidebar::after {
      content:''; position:absolute; bottom:0; left:0; right:0; height:200px;
      background: radial-gradient(ellipse 120% 60% at 50% 100%, rgba(232,57,44,0.2) 0%, transparent 70%);
      pointer-events:none;
    }

    .sidebar-brand {
      padding: 24px 20px;
      display: flex; align-items: center; gap: 10px;
      border-bottom: 1px solid var(--line);
    }
    .sidebar-logo { width:36px; height:36px; object-fit:contain; border-radius:6px; }
    .sidebar-name { font-family:'Bebas Neue',sans-serif; font-size:1.6rem; letter-spacing:.1em; color:var(--white); line-height:1; }
    .sidebar-name span { color:var(--red); }

    .sidebar-section {
      padding: 20px 16px 8px;
      font-size: .6rem; font-weight:700; letter-spacing:.18em;
      text-transform:uppercase; color:var(--muted);
    }

    .sidebar-nav { flex:1; overflow-y:auto; padding-bottom:16px; }
    .sidebar-nav::-webkit-scrollbar { width:3px; }
    .sidebar-nav::-webkit-scrollbar-thumb { background:var(--line); }

    .nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 10px 20px;
      font-size: .88rem; font-weight: 500;
      color: var(--muted);
      text-decoration: none;
      border-radius: 8px;
      margin: 2px 8px;
      transition: background .2s, color .2s;
      position: relative;
    }
    .nav-item:hover { background:rgba(255,255,255,.05); color:var(--soft); }
    .nav-item.active {
      background: rgba(232,57,44,.12);
      color: var(--white);
    }
    .nav-item.active::before {
      content:''; position:absolute; left:-8px; top:50%; transform:translateY(-50%);
      width:3px; height:60%; border-radius:2px; background:var(--red);
    }
    .nav-item svg { width:17px; height:17px; flex-shrink:0; }

    .sidebar-footer {
      padding: 16px 20px;
      border-top: 1px solid var(--line);
      position: relative; z-index: 1;
    }
    .user-chip {
      display: flex; align-items: center; gap: 10px;
    }
    .user-avatar-sm {
      width: 34px; height: 34px; border-radius: 50%;
      background: var(--red);
      display: grid; place-items: center;
      font-family:'Bebas Neue',sans-serif; font-size:.9rem; color:var(--white);
      flex-shrink:0;
    }
    .user-chip-info { flex:1; min-width:0; }
    .user-chip-name { font-size:.82rem; font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .user-chip-role { font-size:.7rem; color:var(--muted); }
    .logout-btn {
      display:flex; align-items:center; justify-content:center;
      width:28px; height:28px; border-radius:6px;
      background:rgba(232,57,44,.1); border:1px solid rgba(232,57,44,.2);
      color:var(--red); cursor:pointer; text-decoration:none;
      transition:background .2s;
    }
    .logout-btn:hover { background:rgba(232,57,44,.2); }
    .logout-btn svg { width:14px; height:14px; }

    /* ══ MAIN AREA ══ */
    .main-area { flex:1; display:flex; flex-direction:column; overflow:hidden; }

    .topbar {
      height: 60px; flex-shrink:0;
      background: var(--card);
      border-bottom: 1px solid var(--line);
      display: flex; align-items: center;
      padding: 0 28px; gap: 16px;
    }
    .topbar-title { font-family:'Bebas Neue',sans-serif; font-size:1.4rem; letter-spacing:.06em; }
    .topbar-breadcrumb { font-size:.75rem; color:var(--muted); margin-left:4px; }
    .topbar-spacer { flex:1; }

    .topbar-badge {
      display:flex; align-items:center; gap:6px;
      font-size:.78rem; color:var(--muted);
      background:var(--surface); border:1px solid var(--line);
      border-radius:20px; padding:5px 12px;
    }
    .topbar-badge svg { width:14px; height:14px; color:var(--teal); }

    .page-body { flex:1; overflow-y:auto; padding:28px; }
    .page-body::-webkit-scrollbar { width:4px; }
    .page-body::-webkit-scrollbar-thumb { background:var(--line); border-radius:2px; }

    ";
        // line 149
        yield from $this->unwrap()->yieldBlock('extra_styles', $context, $blocks);
        // line 150
        yield "  </style>
</head>
<body>
<div class=\"admin-shell\">

  ";
        // line 156
        yield "  <aside class=\"sidebar\">
    <div class=\"sidebar-brand\">
      <img src=\"";
        // line 158
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/logo.png"), "html", null, true);
        yield "\" alt=\"LAMMA\" class=\"sidebar-logo\"/>
      <div class=\"sidebar-name\">LAMMA<span>.</span></div>
    </div>

    <nav class=\"sidebar-nav\">
      <div class=\"sidebar-section\">Core</div>
      <a href=\"";
        // line 164
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_users_index");
        yield "\" class=\"nav-item ";
        yield (((is_string($_v0 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 164, $this->source); })()), "request", [], "any", false, false, false, 164), "get", ["_route"], "method", false, false, false, 164)) && is_string($_v1 = "app_users") && str_starts_with($_v0, $_v1))) ? ("active") : (""));
        yield "\">
        <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2\"/><circle cx=\"9\" cy=\"7\" r=\"4\"/><path d=\"M23 21v-2a4 4 0 0 0-3-3.87\"/><path d=\"M16 3.13a4 4 0 0 1 0 7.75\"/></svg>
        User Management
      </a>

      <div class=\"sidebar-section\">Settings</div>
      <a href=\"";
        // line 170
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\" class=\"nav-item\">
        <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4\"/><polyline points=\"16 17 21 12 16 7\"/><line x1=\"21\" y1=\"12\" x2=\"9\" y2=\"12\"/></svg>
        Sign Out
      </a>
    </nav>

    <div class=\"sidebar-footer\">
      <div class=\"user-chip\">
        <div class=\"user-avatar-sm\">
          ";
        // line 179
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 179, $this->source); })()), "user", [], "any", false, false, false, 179)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 179, $this->source); })()), "user", [], "any", false, false, false, 179), "name", [], "any", false, false, false, 179), 0, 1)), "html", null, true)) : ("A"));
        yield "
        </div>
        <div class=\"user-chip-info\">
          <div class=\"user-chip-name\">";
        // line 182
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 182, $this->source); })()), "user", [], "any", false, false, false, 182)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 182, $this->source); })()), "user", [], "any", false, false, false, 182), "name", [], "any", false, false, false, 182), "html", null, true)) : ("Admin"));
        yield "</div>
          <div class=\"user-chip-role\">";
        // line 183
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 183, $this->source); })()), "user", [], "any", false, false, false, 183)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 183, $this->source); })()), "user", [], "any", false, false, false, 183), "role", [], "any", false, false, false, 183), "html", null, true)) : ("ADMIN"));
        yield "</div>
        </div>
        <a href=\"";
        // line 185
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\" class=\"logout-btn\" title=\"Sign out\">
          <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.5\" stroke-linecap=\"round\"><path d=\"M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4\"/><polyline points=\"16 17 21 12 16 7\"/><line x1=\"21\" y1=\"12\" x2=\"9\" y2=\"12\"/></svg>
        </a>
      </div>
    </div>
  </aside>

  ";
        // line 193
        yield "  <div class=\"main-area\">
    <div class=\"topbar\">
      <div>
        <div class=\"topbar-title\">";
        // line 196
        yield from $this->unwrap()->yieldBlock('page_title', $context, $blocks);
        yield "</div>
        <div class=\"topbar-breadcrumb\">";
        // line 197
        yield from $this->unwrap()->yieldBlock('breadcrumb', $context, $blocks);
        yield "</div>
      </div>
      <div class=\"topbar-spacer\"></div>
      <div class=\"topbar-badge\">
        <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><polyline points=\"12 6 12 12 16 14\"/></svg>
        ";
        // line 202
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "D, d M Y"), "html", null, true);
        yield "
      </div>
    </div>

    <div class=\"page-body\">
      ";
        // line 207
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 208
        yield "    </div>
  </div>

</div>
";
        // line 212
        yield from $this->unwrap()->yieldBlock('extra_scripts', $context, $blocks);
        // line 213
        yield "</body>
</html>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 16
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Dashboard";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 149
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_extra_styles(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_styles"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 196
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_page_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "page_title"));

        yield "Dashboard";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 197
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_breadcrumb(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "breadcrumb"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 207
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 212
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_extra_scripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_scripts"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "admin/base_admin.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  391 => 212,  375 => 207,  359 => 197,  342 => 196,  326 => 149,  309 => 16,  299 => 213,  297 => 212,  291 => 208,  289 => 207,  281 => 202,  273 => 197,  269 => 196,  264 => 193,  254 => 185,  249 => 183,  245 => 182,  239 => 179,  227 => 170,  216 => 164,  207 => 158,  203 => 156,  196 => 150,  194 => 149,  58 => 16,  51 => 11,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# templates/admin/base_admin.html.twig
   Base layout for all LAMMA back-office pages.
   Blocks available:
     - title         → <title> suffix
     - page_title    → H1 inside header
     - breadcrumb    → small text under H1
     - content       → main page body
     - extra_styles  → additional <style> tags
     - extra_scripts → JS at bottom of body
#}
<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta charset=\"UTF-8\"/>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
  <title>LAMMA Admin — {% block title %}Dashboard{% endblock %}</title>
  <link href=\"https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap\" rel=\"stylesheet\"/>
  <style>
    :root {
      --red:     #e8392c;
      --teal:    #2ecfb8;
      --yellow:  #f5c842;
      --dark:    #080809;
      --surface: #0f0f11;
      --card:    #141416;
      --card2:   #1a1a1d;
      --line:    rgba(255,255,255,0.07);
      --muted:   rgba(255,255,255,0.38);
      --soft:    rgba(255,255,255,0.65);
      --white:   #ffffff;
      --sidebar-w: 240px;
    }
    *, *::before, *::after { box-sizing: border-box; margin:0; padding:0; }
    html, body { height:100%; background:var(--dark); color:var(--white); font-family:'DM Sans',sans-serif; overflow:hidden; }

    /* ══ LAYOUT ══ */
    .admin-shell { display:flex; height:100vh; }

    /* ══ SIDEBAR ══ */
    .sidebar {
      width: var(--sidebar-w);
      background: var(--surface);
      border-right: 1px solid var(--line);
      display: flex; flex-direction: column;
      flex-shrink: 0;
      position: relative; z-index: 10;
    }
    .sidebar::after {
      content:''; position:absolute; bottom:0; left:0; right:0; height:200px;
      background: radial-gradient(ellipse 120% 60% at 50% 100%, rgba(232,57,44,0.2) 0%, transparent 70%);
      pointer-events:none;
    }

    .sidebar-brand {
      padding: 24px 20px;
      display: flex; align-items: center; gap: 10px;
      border-bottom: 1px solid var(--line);
    }
    .sidebar-logo { width:36px; height:36px; object-fit:contain; border-radius:6px; }
    .sidebar-name { font-family:'Bebas Neue',sans-serif; font-size:1.6rem; letter-spacing:.1em; color:var(--white); line-height:1; }
    .sidebar-name span { color:var(--red); }

    .sidebar-section {
      padding: 20px 16px 8px;
      font-size: .6rem; font-weight:700; letter-spacing:.18em;
      text-transform:uppercase; color:var(--muted);
    }

    .sidebar-nav { flex:1; overflow-y:auto; padding-bottom:16px; }
    .sidebar-nav::-webkit-scrollbar { width:3px; }
    .sidebar-nav::-webkit-scrollbar-thumb { background:var(--line); }

    .nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 10px 20px;
      font-size: .88rem; font-weight: 500;
      color: var(--muted);
      text-decoration: none;
      border-radius: 8px;
      margin: 2px 8px;
      transition: background .2s, color .2s;
      position: relative;
    }
    .nav-item:hover { background:rgba(255,255,255,.05); color:var(--soft); }
    .nav-item.active {
      background: rgba(232,57,44,.12);
      color: var(--white);
    }
    .nav-item.active::before {
      content:''; position:absolute; left:-8px; top:50%; transform:translateY(-50%);
      width:3px; height:60%; border-radius:2px; background:var(--red);
    }
    .nav-item svg { width:17px; height:17px; flex-shrink:0; }

    .sidebar-footer {
      padding: 16px 20px;
      border-top: 1px solid var(--line);
      position: relative; z-index: 1;
    }
    .user-chip {
      display: flex; align-items: center; gap: 10px;
    }
    .user-avatar-sm {
      width: 34px; height: 34px; border-radius: 50%;
      background: var(--red);
      display: grid; place-items: center;
      font-family:'Bebas Neue',sans-serif; font-size:.9rem; color:var(--white);
      flex-shrink:0;
    }
    .user-chip-info { flex:1; min-width:0; }
    .user-chip-name { font-size:.82rem; font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .user-chip-role { font-size:.7rem; color:var(--muted); }
    .logout-btn {
      display:flex; align-items:center; justify-content:center;
      width:28px; height:28px; border-radius:6px;
      background:rgba(232,57,44,.1); border:1px solid rgba(232,57,44,.2);
      color:var(--red); cursor:pointer; text-decoration:none;
      transition:background .2s;
    }
    .logout-btn:hover { background:rgba(232,57,44,.2); }
    .logout-btn svg { width:14px; height:14px; }

    /* ══ MAIN AREA ══ */
    .main-area { flex:1; display:flex; flex-direction:column; overflow:hidden; }

    .topbar {
      height: 60px; flex-shrink:0;
      background: var(--card);
      border-bottom: 1px solid var(--line);
      display: flex; align-items: center;
      padding: 0 28px; gap: 16px;
    }
    .topbar-title { font-family:'Bebas Neue',sans-serif; font-size:1.4rem; letter-spacing:.06em; }
    .topbar-breadcrumb { font-size:.75rem; color:var(--muted); margin-left:4px; }
    .topbar-spacer { flex:1; }

    .topbar-badge {
      display:flex; align-items:center; gap:6px;
      font-size:.78rem; color:var(--muted);
      background:var(--surface); border:1px solid var(--line);
      border-radius:20px; padding:5px 12px;
    }
    .topbar-badge svg { width:14px; height:14px; color:var(--teal); }

    .page-body { flex:1; overflow-y:auto; padding:28px; }
    .page-body::-webkit-scrollbar { width:4px; }
    .page-body::-webkit-scrollbar-thumb { background:var(--line); border-radius:2px; }

    {% block extra_styles %}{% endblock %}
  </style>
</head>
<body>
<div class=\"admin-shell\">

  {# ══ SIDEBAR ══ #}
  <aside class=\"sidebar\">
    <div class=\"sidebar-brand\">
      <img src=\"{{ asset('images/logo.png') }}\" alt=\"LAMMA\" class=\"sidebar-logo\"/>
      <div class=\"sidebar-name\">LAMMA<span>.</span></div>
    </div>

    <nav class=\"sidebar-nav\">
      <div class=\"sidebar-section\">Core</div>
      <a href=\"{{ path('app_users_index') }}\" class=\"nav-item {{ app.request.get('_route') starts with 'app_users' ? 'active' : '' }}\">
        <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2\"/><circle cx=\"9\" cy=\"7\" r=\"4\"/><path d=\"M23 21v-2a4 4 0 0 0-3-3.87\"/><path d=\"M16 3.13a4 4 0 0 1 0 7.75\"/></svg>
        User Management
      </a>

      <div class=\"sidebar-section\">Settings</div>
      <a href=\"{{ path('app_logout') }}\" class=\"nav-item\">
        <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4\"/><polyline points=\"16 17 21 12 16 7\"/><line x1=\"21\" y1=\"12\" x2=\"9\" y2=\"12\"/></svg>
        Sign Out
      </a>
    </nav>

    <div class=\"sidebar-footer\">
      <div class=\"user-chip\">
        <div class=\"user-avatar-sm\">
          {{ app.user ? app.user.name|slice(0,1)|upper : 'A' }}
        </div>
        <div class=\"user-chip-info\">
          <div class=\"user-chip-name\">{{ app.user ? app.user.name : 'Admin' }}</div>
          <div class=\"user-chip-role\">{{ app.user ? app.user.role : 'ADMIN' }}</div>
        </div>
        <a href=\"{{ path('app_logout') }}\" class=\"logout-btn\" title=\"Sign out\">
          <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.5\" stroke-linecap=\"round\"><path d=\"M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4\"/><polyline points=\"16 17 21 12 16 7\"/><line x1=\"21\" y1=\"12\" x2=\"9\" y2=\"12\"/></svg>
        </a>
      </div>
    </div>
  </aside>

  {# ══ MAIN ══ #}
  <div class=\"main-area\">
    <div class=\"topbar\">
      <div>
        <div class=\"topbar-title\">{% block page_title %}Dashboard{% endblock %}</div>
        <div class=\"topbar-breadcrumb\">{% block breadcrumb %}{% endblock %}</div>
      </div>
      <div class=\"topbar-spacer\"></div>
      <div class=\"topbar-badge\">
        <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><polyline points=\"12 6 12 12 16 14\"/></svg>
        {{ \"now\"|date(\"D, d M Y\") }}
      </div>
    </div>

    <div class=\"page-body\">
      {% block content %}{% endblock %}
    </div>
  </div>

</div>
{% block extra_scripts %}{% endblock %}
</body>
</html>
", "admin/base_admin.html.twig", "C:\\Users\\saifl\\OneDrive\\Desktop\\back_saif2\\user_symfony_saif\\user_saif\\templates\\admin\\base_admin.html.twig");
    }
}
