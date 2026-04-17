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

/* base_auth.html.twig */
class __TwigTemplate_28a1b5b855884b8bdab9705c4dafec00 extends Template
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
            'hero_eyebrow' => [$this, 'block_hero_eyebrow'],
            'hero_title' => [$this, 'block_hero_title'],
            'hero_desc' => [$this, 'block_hero_desc'],
            'form_content' => [$this, 'block_form_content'],
            'extra_scripts' => [$this, 'block_extra_scripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base_auth.html.twig"));

        // line 10
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta charset=\"UTF-8\"/>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
  <title>LAMMA — ";
        // line 15
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
  <link href=\"https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap\" rel=\"stylesheet\"/>
  <style>
    :root {
      --red:      #e8392c;
      --teal:     #2ecfb8;
      --yellow:   #f5c842;
      --dark:     #080809;
      --surface:  #0f0f11;
      --card:     #141416;
      --line:     rgba(255,255,255,0.07);
      --muted:    rgba(255,255,255,0.38);
      --soft:     rgba(255,255,255,0.65);
      --white:    #ffffff;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; background: var(--dark); color: var(--white); font-family: 'DM Sans', sans-serif; overflow: hidden; }

    .page { display: grid; grid-template-columns: 1fr 1fr; height: 100vh; }

    /* ══ LEFT VISUAL ══ */
    .visual { position:relative; overflow:hidden; background:var(--surface); display:flex; flex-direction:column; justify-content:space-between; padding:44px 52px; }
    .visual::before {
      content:''; position:absolute; inset:0;
      background:
        radial-gradient(ellipse 90% 55% at 30% 100%, rgba(232,57,44,0.40) 0%, transparent 60%),
        radial-gradient(ellipse 60% 45% at 85% 5%,   rgba(46,207,184,0.22) 0%, transparent 55%),
        radial-gradient(ellipse 50% 40% at 50% 50%,  rgba(245,200,66,0.07) 0%, transparent 70%);
      pointer-events:none;
    }
    .visual::after {
      content:''; position:absolute; inset:0;
      background-image:url(\"data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E\");
      background-size:200px; opacity:0.6; pointer-events:none;
    }
    .beams { position:absolute; inset:0; pointer-events:none; overflow:hidden; }
    .beam { position:absolute; bottom:-10px; width:1.5px; background:linear-gradient(to top,rgba(255,255,255,0.13),transparent); animation:pulse 5s ease-in-out infinite alternate; }
    .beam:nth-child(1){ left:15%; height:70%; transform:rotate(-18deg); animation-delay:0s; }
    .beam:nth-child(2){ left:28%; height:82%; transform:rotate(-7deg);  animation-delay:.9s;  background:linear-gradient(to top,rgba(46,207,184,0.18),transparent); }
    .beam:nth-child(3){ left:45%; height:95%; transform:rotate(0deg);   animation-delay:1.7s; }
    .beam:nth-child(4){ left:63%; height:68%; transform:rotate(9deg);   animation-delay:.4s;  background:linear-gradient(to top,rgba(232,57,44,0.18),transparent); }
    .beam:nth-child(5){ left:79%; height:78%; transform:rotate(17deg);  animation-delay:1.2s; }
    @keyframes pulse { 0%{opacity:.4} 100%{opacity:1} }

    .blob { position:absolute; border-radius:50%; filter:blur(1px); }
    .blob-1 { width:180px; height:180px; background:var(--yellow); bottom:80px; left:-60px; opacity:.78; animation:drift 8s ease-in-out infinite alternate; }
    .blob-2 { width:130px; height:155px; border-radius:50% 50% 50% 10%; background:var(--teal); top:50px; right:-40px; opacity:.82; animation:drift 10s ease-in-out infinite alternate-reverse; }
    @keyframes drift { 0%{transform:translateY(0) rotate(0deg)} 100%{transform:translateY(16px) rotate(6deg)} }

    .brand { position:relative; z-index:2; display:flex; align-items:center; gap:10px; }
    .brand-logo { width:44px; height:44px; object-fit:contain; border-radius:6px; filter:drop-shadow(0 2px 6px rgba(0,0,0,0.5)); }
    .brand-name { font-family:'Bebas Neue',sans-serif; font-size:1.9rem; letter-spacing:.12em; color:var(--white); line-height:1; }
    .brand-name span { color:var(--red); }

    .hero { position:relative; z-index:2; }
    .hero-eyebrow { font-size:.72rem; font-weight:600; letter-spacing:.22em; text-transform:uppercase; color:var(--red); margin-bottom:18px; display:flex; align-items:center; gap:10px; }
    .hero-eyebrow::before { content:''; display:block; width:32px; height:1.5px; background:var(--red); }
    .hero-title { font-family:'Bebas Neue',sans-serif; font-size:clamp(3.8rem,5.5vw,6rem); line-height:.92; letter-spacing:.06em; margin-bottom:22px; }
    .hero-title .outline { -webkit-text-stroke:1.5px rgba(255,255,255,.55); color:transparent; }
    .hero-desc { font-size:.9rem; font-weight:300; color:var(--soft); line-height:1.7; max-width:300px; }

    .stats { position:relative; z-index:2; display:flex; gap:36px; }
    .stat-num { font-family:'Bebas Neue',sans-serif; font-size:2rem; color:var(--white); letter-spacing:.06em; line-height:1; }
    .stat-label { font-size:.7rem; font-weight:500; letter-spacing:.1em; text-transform:uppercase; color:var(--muted); margin-top:3px; }
    .stat-divider { width:1px; background:var(--line); align-self:stretch; }

    /* ══ RIGHT FORM PANEL ══ */
    .form-panel { background:var(--card); overflow-y:auto; display:flex; align-items:flex-start; justify-content:center; padding:44px 52px; position:relative; }
    .form-panel::before { content:''; position:absolute; top:0; right:0; width:280px; height:280px; background:radial-gradient(circle,rgba(46,207,184,0.06) 0%,transparent 70%); pointer-events:none; }
    .form-panel::-webkit-scrollbar { width:4px; }
    .form-panel::-webkit-scrollbar-thumb { background:var(--line); border-radius:2px; }
    .form-inner { width:100%; max-width:420px; padding-bottom:20px; }

    /* shared field styles */
    .form-header { margin-bottom:28px; }
    .form-header h1 { font-family:'Bebas Neue',sans-serif; font-size:2.4rem; letter-spacing:.08em; margin-bottom:6px; }
    .form-header p { font-size:.85rem; color:var(--muted); line-height:1.6; }

    .fields { display:flex; flex-direction:column; gap:18px; }
    .row { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
    .field { display:flex; flex-direction:column; gap:7px; }

    label { font-size:.7rem; font-weight:600; letter-spacing:.12em; text-transform:uppercase; color:var(--muted); }
    .opt-tag { display:inline-block; font-size:.6rem; font-weight:500; letter-spacing:.06em; color:var(--muted); background:rgba(255,255,255,.05); border:1px solid var(--line); border-radius:3px; padding:1px 6px; margin-left:6px; vertical-align:middle; text-transform:uppercase; }

    .input-wrap { position:relative; }
    .input-icon { position:absolute; left:14px; top:50%; transform:translateY(-50%); pointer-events:none; color:var(--muted); display:flex; }

    input, select {
      width:100%; background:var(--surface); border:1px solid var(--line); border-radius:8px;
      padding:13px 14px 13px 42px; font-family:'DM Sans',sans-serif;
      font-size:.9rem; color:var(--white); outline:none; -webkit-appearance:none;
      transition:border-color .25s, box-shadow .25s, background .25s;
    }
    input::placeholder { color:rgba(255,255,255,.2); }
    input:focus, select:focus { border-color:var(--teal); background:rgba(46,207,184,.06); box-shadow:0 0 0 3px rgba(46,207,184,.1); }
    select option { background:#0f0f11; }

    .eye { position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:var(--muted); display:flex; align-items:center; transition:color .2s; }
    .eye:hover { color:var(--white); }

    .sep { display:flex; align-items:center; gap:12px; margin:4px 0; }
    .sep span { font-size:.68rem; letter-spacing:.1em; text-transform:uppercase; color:var(--teal); font-weight:600; white-space:nowrap; }
    .sep::before, .sep::after { content:''; flex:1; height:1px; background:var(--line); }

    .btn-submit { width:100%; margin-top:4px; padding:15px; background:var(--red); border:none; border-radius:8px; font-family:'Bebas Neue',sans-serif; font-size:1.15rem; letter-spacing:.14em; color:var(--white); cursor:pointer; position:relative; overflow:hidden; transition:background .2s,transform .15s,box-shadow .2s; }
    .btn-submit::after { content:''; position:absolute; inset:0; background:linear-gradient(90deg,transparent,rgba(255,255,255,.1),transparent); transform:translateX(-120%); transition:transform .55s; }
    .btn-submit:hover { background:#c93228; transform:translateY(-2px); box-shadow:0 12px 32px rgba(232,57,44,.35); }
    .btn-submit:hover::after { transform:translateX(120%); }
    .btn-submit:active { transform:translateY(0); }

    .or-row { display:flex; align-items:center; gap:14px; margin:22px 0 16px; }
    .or-row span { font-size:.75rem; color:var(--muted); white-space:nowrap; }
    .or-row::before, .or-row::after { content:''; flex:1; height:1px; background:var(--line); }

    .social-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    .btn-social { display:flex; align-items:center; justify-content:center; gap:9px; padding:12px; background:var(--surface); border:1px solid var(--line); border-radius:8px; font-family:'DM Sans',sans-serif; font-size:.88rem; font-weight:500; color:var(--soft); cursor:pointer; transition:border-color .2s,background .2s,color .2s; }
    .btn-social:hover { border-color:rgba(255,255,255,.2); background:rgba(255,255,255,.05); color:var(--white); }

    .bottom-link { text-align:center; font-size:.82rem; color:var(--muted); margin-top:20px; }
    .bottom-link a { color:var(--teal); font-weight:600; text-decoration:none; }
    .bottom-link a:hover { text-decoration:underline; }

    /* flash messages */
    .flash { padding:12px 16px; border-radius:8px; font-size:.85rem; margin-bottom:20px; border:1px solid; }
    .flash-error   { background:rgba(232,57,44,.1);   border-color:rgba(232,57,44,.3);   color:#ff8a80; }
    .flash-success { background:rgba(46,207,184,.1);  border-color:rgba(46,207,184,.3);  color:#2ecfb8; }
    .flash-warning { background:rgba(245,200,66,.1);  border-color:rgba(245,200,66,.3);  color:#f5c842; }

    @media (max-width:900px) {
      html,body { overflow:auto; }
      .page { grid-template-columns:1fr; height:auto; }
      .visual { min-height:300px; }
      .form-panel { padding:40px 28px; }
      .row { grid-template-columns:1fr; }
    }

    ";
        // line 152
        yield from $this->unwrap()->yieldBlock('extra_styles', $context, $blocks);
        // line 153
        yield "  </style>
</head>
<body>
<div class=\"page\">

  ";
        // line 159
        yield "  <div class=\"visual\">
    <div class=\"beams\">
      <div class=\"beam\"></div><div class=\"beam\"></div>
      <div class=\"beam\"></div><div class=\"beam\"></div><div class=\"beam\"></div>
    </div>
    <div class=\"blob blob-1\"></div>
    <div class=\"blob blob-2\"></div>

    <div class=\"brand\">
      ";
        // line 169
        yield "      <img src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/logo.png"), "html", null, true);
        yield "\" alt=\"LAMMA Logo\" class=\"brand-logo\"/>
      <div class=\"brand-name\">LAMMA<span>.</span></div>
    </div>

    <div class=\"hero\">
      <p class=\"hero-eyebrow\">";
        // line 174
        yield from $this->unwrap()->yieldBlock('hero_eyebrow', $context, $blocks);
        yield "</p>
      <h2 class=\"hero-title\">";
        // line 175
        yield from $this->unwrap()->yieldBlock('hero_title', $context, $blocks);
        yield "</h2>
      <p class=\"hero-desc\">";
        // line 176
        yield from $this->unwrap()->yieldBlock('hero_desc', $context, $blocks);
        yield "</p>
    </div>

    <div class=\"stats\">
      <div><div class=\"stat-num\">320+</div><div class=\"stat-label\">Campsites</div></div>
      <div class=\"stat-divider\"></div>
      <div><div class=\"stat-num\">48K</div><div class=\"stat-label\">Campers</div></div>
      <div class=\"stat-divider\"></div>
      <div><div class=\"stat-num\">12+</div><div class=\"stat-label\">Regions</div></div>
    </div>
  </div>

  ";
        // line 189
        yield "  <div class=\"form-panel\">
    <div class=\"form-inner\">

      ";
        // line 193
        yield "      ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 193, $this->source); })()), "flashes", [], "any", false, false, false, 193));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 194
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 195
                yield "          <div class=\"flash flash-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "</div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 197
            yield "      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 198
        yield "
      ";
        // line 199
        yield from $this->unwrap()->yieldBlock('form_content', $context, $blocks);
        // line 200
        yield "
    </div>
  </div>

</div>

";
        // line 206
        yield from $this->unwrap()->yieldBlock('extra_scripts', $context, $blocks);
        // line 207
        yield "</body>
</html>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 15
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 152
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

    // line 174
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_hero_eyebrow(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "hero_eyebrow"));

        yield "Nature &amp; Adventure";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 175
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_hero_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "hero_title"));

        yield "INTO<br/>THE<br/><span class=\"outline\">WILD</span>";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 176
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_hero_desc(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "hero_desc"));

        yield "Where every trail leads to a new story. Join LAMMA and plan your next unforgettable camping adventure.";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 199
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_form_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "form_content"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 206
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
        return "base_auth.html.twig";
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
        return array (  407 => 206,  391 => 199,  374 => 176,  357 => 175,  340 => 174,  324 => 152,  308 => 15,  298 => 207,  296 => 206,  288 => 200,  286 => 199,  283 => 198,  277 => 197,  266 => 195,  261 => 194,  256 => 193,  251 => 189,  236 => 176,  232 => 175,  228 => 174,  219 => 169,  208 => 159,  201 => 153,  199 => 152,  59 => 15,  52 => 10,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# templates/base_auth.html.twig
   Shared base layout for all LAMMA auth pages (login, register, etc.)
   Extend this template and fill the blocks below:
     - {% block title %}        → page <title>
     - {% block hero_eyebrow %} → small red label above the big title
     - {% block hero_title %}   → large Bebas Neue title (HTML allowed)
     - {% block hero_desc %}    → short paragraph under the title
     - {% block form_content %} → the entire right-hand form area
#}
<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta charset=\"UTF-8\"/>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
  <title>LAMMA — {% block title %}{% endblock %}</title>
  <link href=\"https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap\" rel=\"stylesheet\"/>
  <style>
    :root {
      --red:      #e8392c;
      --teal:     #2ecfb8;
      --yellow:   #f5c842;
      --dark:     #080809;
      --surface:  #0f0f11;
      --card:     #141416;
      --line:     rgba(255,255,255,0.07);
      --muted:    rgba(255,255,255,0.38);
      --soft:     rgba(255,255,255,0.65);
      --white:    #ffffff;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; background: var(--dark); color: var(--white); font-family: 'DM Sans', sans-serif; overflow: hidden; }

    .page { display: grid; grid-template-columns: 1fr 1fr; height: 100vh; }

    /* ══ LEFT VISUAL ══ */
    .visual { position:relative; overflow:hidden; background:var(--surface); display:flex; flex-direction:column; justify-content:space-between; padding:44px 52px; }
    .visual::before {
      content:''; position:absolute; inset:0;
      background:
        radial-gradient(ellipse 90% 55% at 30% 100%, rgba(232,57,44,0.40) 0%, transparent 60%),
        radial-gradient(ellipse 60% 45% at 85% 5%,   rgba(46,207,184,0.22) 0%, transparent 55%),
        radial-gradient(ellipse 50% 40% at 50% 50%,  rgba(245,200,66,0.07) 0%, transparent 70%);
      pointer-events:none;
    }
    .visual::after {
      content:''; position:absolute; inset:0;
      background-image:url(\"data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E\");
      background-size:200px; opacity:0.6; pointer-events:none;
    }
    .beams { position:absolute; inset:0; pointer-events:none; overflow:hidden; }
    .beam { position:absolute; bottom:-10px; width:1.5px; background:linear-gradient(to top,rgba(255,255,255,0.13),transparent); animation:pulse 5s ease-in-out infinite alternate; }
    .beam:nth-child(1){ left:15%; height:70%; transform:rotate(-18deg); animation-delay:0s; }
    .beam:nth-child(2){ left:28%; height:82%; transform:rotate(-7deg);  animation-delay:.9s;  background:linear-gradient(to top,rgba(46,207,184,0.18),transparent); }
    .beam:nth-child(3){ left:45%; height:95%; transform:rotate(0deg);   animation-delay:1.7s; }
    .beam:nth-child(4){ left:63%; height:68%; transform:rotate(9deg);   animation-delay:.4s;  background:linear-gradient(to top,rgba(232,57,44,0.18),transparent); }
    .beam:nth-child(5){ left:79%; height:78%; transform:rotate(17deg);  animation-delay:1.2s; }
    @keyframes pulse { 0%{opacity:.4} 100%{opacity:1} }

    .blob { position:absolute; border-radius:50%; filter:blur(1px); }
    .blob-1 { width:180px; height:180px; background:var(--yellow); bottom:80px; left:-60px; opacity:.78; animation:drift 8s ease-in-out infinite alternate; }
    .blob-2 { width:130px; height:155px; border-radius:50% 50% 50% 10%; background:var(--teal); top:50px; right:-40px; opacity:.82; animation:drift 10s ease-in-out infinite alternate-reverse; }
    @keyframes drift { 0%{transform:translateY(0) rotate(0deg)} 100%{transform:translateY(16px) rotate(6deg)} }

    .brand { position:relative; z-index:2; display:flex; align-items:center; gap:10px; }
    .brand-logo { width:44px; height:44px; object-fit:contain; border-radius:6px; filter:drop-shadow(0 2px 6px rgba(0,0,0,0.5)); }
    .brand-name { font-family:'Bebas Neue',sans-serif; font-size:1.9rem; letter-spacing:.12em; color:var(--white); line-height:1; }
    .brand-name span { color:var(--red); }

    .hero { position:relative; z-index:2; }
    .hero-eyebrow { font-size:.72rem; font-weight:600; letter-spacing:.22em; text-transform:uppercase; color:var(--red); margin-bottom:18px; display:flex; align-items:center; gap:10px; }
    .hero-eyebrow::before { content:''; display:block; width:32px; height:1.5px; background:var(--red); }
    .hero-title { font-family:'Bebas Neue',sans-serif; font-size:clamp(3.8rem,5.5vw,6rem); line-height:.92; letter-spacing:.06em; margin-bottom:22px; }
    .hero-title .outline { -webkit-text-stroke:1.5px rgba(255,255,255,.55); color:transparent; }
    .hero-desc { font-size:.9rem; font-weight:300; color:var(--soft); line-height:1.7; max-width:300px; }

    .stats { position:relative; z-index:2; display:flex; gap:36px; }
    .stat-num { font-family:'Bebas Neue',sans-serif; font-size:2rem; color:var(--white); letter-spacing:.06em; line-height:1; }
    .stat-label { font-size:.7rem; font-weight:500; letter-spacing:.1em; text-transform:uppercase; color:var(--muted); margin-top:3px; }
    .stat-divider { width:1px; background:var(--line); align-self:stretch; }

    /* ══ RIGHT FORM PANEL ══ */
    .form-panel { background:var(--card); overflow-y:auto; display:flex; align-items:flex-start; justify-content:center; padding:44px 52px; position:relative; }
    .form-panel::before { content:''; position:absolute; top:0; right:0; width:280px; height:280px; background:radial-gradient(circle,rgba(46,207,184,0.06) 0%,transparent 70%); pointer-events:none; }
    .form-panel::-webkit-scrollbar { width:4px; }
    .form-panel::-webkit-scrollbar-thumb { background:var(--line); border-radius:2px; }
    .form-inner { width:100%; max-width:420px; padding-bottom:20px; }

    /* shared field styles */
    .form-header { margin-bottom:28px; }
    .form-header h1 { font-family:'Bebas Neue',sans-serif; font-size:2.4rem; letter-spacing:.08em; margin-bottom:6px; }
    .form-header p { font-size:.85rem; color:var(--muted); line-height:1.6; }

    .fields { display:flex; flex-direction:column; gap:18px; }
    .row { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
    .field { display:flex; flex-direction:column; gap:7px; }

    label { font-size:.7rem; font-weight:600; letter-spacing:.12em; text-transform:uppercase; color:var(--muted); }
    .opt-tag { display:inline-block; font-size:.6rem; font-weight:500; letter-spacing:.06em; color:var(--muted); background:rgba(255,255,255,.05); border:1px solid var(--line); border-radius:3px; padding:1px 6px; margin-left:6px; vertical-align:middle; text-transform:uppercase; }

    .input-wrap { position:relative; }
    .input-icon { position:absolute; left:14px; top:50%; transform:translateY(-50%); pointer-events:none; color:var(--muted); display:flex; }

    input, select {
      width:100%; background:var(--surface); border:1px solid var(--line); border-radius:8px;
      padding:13px 14px 13px 42px; font-family:'DM Sans',sans-serif;
      font-size:.9rem; color:var(--white); outline:none; -webkit-appearance:none;
      transition:border-color .25s, box-shadow .25s, background .25s;
    }
    input::placeholder { color:rgba(255,255,255,.2); }
    input:focus, select:focus { border-color:var(--teal); background:rgba(46,207,184,.06); box-shadow:0 0 0 3px rgba(46,207,184,.1); }
    select option { background:#0f0f11; }

    .eye { position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:var(--muted); display:flex; align-items:center; transition:color .2s; }
    .eye:hover { color:var(--white); }

    .sep { display:flex; align-items:center; gap:12px; margin:4px 0; }
    .sep span { font-size:.68rem; letter-spacing:.1em; text-transform:uppercase; color:var(--teal); font-weight:600; white-space:nowrap; }
    .sep::before, .sep::after { content:''; flex:1; height:1px; background:var(--line); }

    .btn-submit { width:100%; margin-top:4px; padding:15px; background:var(--red); border:none; border-radius:8px; font-family:'Bebas Neue',sans-serif; font-size:1.15rem; letter-spacing:.14em; color:var(--white); cursor:pointer; position:relative; overflow:hidden; transition:background .2s,transform .15s,box-shadow .2s; }
    .btn-submit::after { content:''; position:absolute; inset:0; background:linear-gradient(90deg,transparent,rgba(255,255,255,.1),transparent); transform:translateX(-120%); transition:transform .55s; }
    .btn-submit:hover { background:#c93228; transform:translateY(-2px); box-shadow:0 12px 32px rgba(232,57,44,.35); }
    .btn-submit:hover::after { transform:translateX(120%); }
    .btn-submit:active { transform:translateY(0); }

    .or-row { display:flex; align-items:center; gap:14px; margin:22px 0 16px; }
    .or-row span { font-size:.75rem; color:var(--muted); white-space:nowrap; }
    .or-row::before, .or-row::after { content:''; flex:1; height:1px; background:var(--line); }

    .social-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    .btn-social { display:flex; align-items:center; justify-content:center; gap:9px; padding:12px; background:var(--surface); border:1px solid var(--line); border-radius:8px; font-family:'DM Sans',sans-serif; font-size:.88rem; font-weight:500; color:var(--soft); cursor:pointer; transition:border-color .2s,background .2s,color .2s; }
    .btn-social:hover { border-color:rgba(255,255,255,.2); background:rgba(255,255,255,.05); color:var(--white); }

    .bottom-link { text-align:center; font-size:.82rem; color:var(--muted); margin-top:20px; }
    .bottom-link a { color:var(--teal); font-weight:600; text-decoration:none; }
    .bottom-link a:hover { text-decoration:underline; }

    /* flash messages */
    .flash { padding:12px 16px; border-radius:8px; font-size:.85rem; margin-bottom:20px; border:1px solid; }
    .flash-error   { background:rgba(232,57,44,.1);   border-color:rgba(232,57,44,.3);   color:#ff8a80; }
    .flash-success { background:rgba(46,207,184,.1);  border-color:rgba(46,207,184,.3);  color:#2ecfb8; }
    .flash-warning { background:rgba(245,200,66,.1);  border-color:rgba(245,200,66,.3);  color:#f5c842; }

    @media (max-width:900px) {
      html,body { overflow:auto; }
      .page { grid-template-columns:1fr; height:auto; }
      .visual { min-height:300px; }
      .form-panel { padding:40px 28px; }
      .row { grid-template-columns:1fr; }
    }

    {% block extra_styles %}{% endblock %}
  </style>
</head>
<body>
<div class=\"page\">

  {# ══ LEFT VISUAL PANEL (shared across all auth pages) ══ #}
  <div class=\"visual\">
    <div class=\"beams\">
      <div class=\"beam\"></div><div class=\"beam\"></div>
      <div class=\"beam\"></div><div class=\"beam\"></div><div class=\"beam\"></div>
    </div>
    <div class=\"blob blob-1\"></div>
    <div class=\"blob blob-2\"></div>

    <div class=\"brand\">
      {# Place your logo in public/images/logo.png and use asset() #}
      <img src=\"{{ asset('images/logo.png') }}\" alt=\"LAMMA Logo\" class=\"brand-logo\"/>
      <div class=\"brand-name\">LAMMA<span>.</span></div>
    </div>

    <div class=\"hero\">
      <p class=\"hero-eyebrow\">{% block hero_eyebrow %}Nature &amp; Adventure{% endblock %}</p>
      <h2 class=\"hero-title\">{% block hero_title %}INTO<br/>THE<br/><span class=\"outline\">WILD</span>{% endblock %}</h2>
      <p class=\"hero-desc\">{% block hero_desc %}Where every trail leads to a new story. Join LAMMA and plan your next unforgettable camping adventure.{% endblock %}</p>
    </div>

    <div class=\"stats\">
      <div><div class=\"stat-num\">320+</div><div class=\"stat-label\">Campsites</div></div>
      <div class=\"stat-divider\"></div>
      <div><div class=\"stat-num\">48K</div><div class=\"stat-label\">Campers</div></div>
      <div class=\"stat-divider\"></div>
      <div><div class=\"stat-num\">12+</div><div class=\"stat-label\">Regions</div></div>
    </div>
  </div>

  {# ══ RIGHT FORM PANEL ══ #}
  <div class=\"form-panel\">
    <div class=\"form-inner\">

      {# Flash messages — Symfony flash bag #}
      {% for label, messages in app.flashes %}
        {% for message in messages %}
          <div class=\"flash flash-{{ label }}\">{{ message }}</div>
        {% endfor %}
      {% endfor %}

      {% block form_content %}{% endblock %}

    </div>
  </div>

</div>

{% block extra_scripts %}{% endblock %}
</body>
</html>
", "base_auth.html.twig", "C:\\Users\\saifl\\OneDrive\\Desktop\\back_saif2\\user_symfony_saif\\user_saif\\templates\\base_auth.html.twig");
    }
}
