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

/* security/register.html.twig */
class __TwigTemplate_59362b32c5d90727e210ca44f4256da2 extends Template
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

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'hero_eyebrow' => [$this, 'block_hero_eyebrow'],
            'hero_title' => [$this, 'block_hero_title'],
            'hero_desc' => [$this, 'block_hero_desc'],
            'extra_styles' => [$this, 'block_extra_styles'],
            'form_content' => [$this, 'block_form_content'],
            'extra_scripts' => [$this, 'block_extra_scripts'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 7
        return "base_auth.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/register.html.twig"));

        $this->parent = $this->load("base_auth.html.twig", 7);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Create Account";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 11
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

    // line 13
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_hero_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "hero_title"));

        // line 14
        yield "  INTO<br/>
  THE<br/>
  <span class=\"outline\">WILD</span>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 19
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_hero_desc(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "hero_desc"));

        // line 20
        yield "  Where every trail leads to a new story. Join LAMMA and plan your next unforgettable camping adventure.
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 23
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_extra_styles(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_styles"));

        // line 24
        yield "  /* ── Avatar uploader ── */
  .avatar-section { display:flex; align-items:center; gap:20px; margin-bottom:36px; padding-bottom:36px; border-bottom:1px solid var(--line); }
  .avatar-ring { position:relative; flex-shrink:0; }
  .avatar-preview { width:86px; height:86px; border-radius:50%; background:var(--surface); border:2px solid var(--line); object-fit:cover; display:block; transition:border-color .3s; }
  .avatar-ring:hover .avatar-preview { border-color:var(--teal); }
  .avatar-edit { position:absolute; bottom:0; right:0; width:26px; height:26px; border-radius:50%; background:var(--red); border:2px solid var(--card); display:grid; place-items:center; cursor:pointer; transition:background .2s,transform .2s; }
  .avatar-edit:hover { background:#c42e23; transform:scale(1.1); }
  .avatar-edit svg { width:12px; height:12px; }
  .avatar-info h3 { font-size:.95rem; font-weight:600; margin-bottom:4px; }
  .avatar-info p { font-size:.78rem; color:var(--muted); line-height:1.5; }
  .avatar-btn { display:inline-block; margin-top:8px; font-size:.75rem; font-weight:600; letter-spacing:.06em; color:var(--teal); cursor:pointer; background:none; border:none; padding:0; transition:opacity .2s; }
  .avatar-btn:hover { opacity:.7; }

  /* ── Password strength ── */
  .strength-bar { height:2px; background:var(--line); border-radius:2px; overflow:hidden; margin-top:8px; }
  .strength-fill { height:100%; width:0%; border-radius:2px; transition:width .4s,background .4s; }
  .strength-label { font-size:.68rem; color:var(--muted); margin-top:4px; }

  /* ── Inline field errors ── */
  .field-error { font-size:.72rem; color:#ff8a80; margin-top:4px; }
  input.is-invalid, select.is-invalid { border-color:#e8392c !important; }
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 47
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_form_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "form_content"));

        // line 48
        yield "
  <div class=\"form-header\">
    <h1>Create Account</h1>
    <p>Join LAMMA and start planning your next camping adventure in the wild.</p>
  </div>

  ";
        // line 55
        yield "  <div class=\"avatar-section\">
    <div class=\"avatar-ring\">
      <img id=\"avatar-preview\" class=\"avatar-preview\"
        src=\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 86 86'%3E%3Crect width='86' height='86' fill='%230f0f11'/%3E%3Ccircle cx='43' cy='34' r='16' fill='%23222'/%3E%3Cellipse cx='43' cy='72' rx='26' ry='18' fill='%23222'/%3E%3C/svg%3E\"
        alt=\"Profile preview\"/>
      <label for=\"registration_form_imageFile\" class=\"avatar-edit\" title=\"Upload photo\">
        <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"white\" stroke-width=\"2.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
          <path d=\"M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4\"/>
          <polyline points=\"17 8 12 3 7 8\"/>
          <line x1=\"12\" y1=\"3\" x2=\"12\" y2=\"15\"/>
        </svg>
      </label>
    </div>
    <div class=\"avatar-info\">
      <h3>Profile Photo</h3>
      <p>PNG, JPG or WEBP · Max 2 MB</p>
      <button type=\"button\" class=\"avatar-btn\" onclick=\"document.getElementById('registration_form_imageFile').click()\">Upload photo →</button>
    </div>
  </div>

  ";
        // line 76
        yield "  ";
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 76, $this->source); })()), 'form_start', ["action" => $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register"), "method" => "POST", "attr" => ["novalidate" => "novalidate", "id" => "register-form"], "multipart" => true]);
        // line 81
        yield "

    ";
        // line 84
        yield "    <div style=\"display:none\">
      ";
        // line 85
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 85, $this->source); })()), "imageFile", [], "any", false, false, false, 85), 'widget');
        yield "
    </div>

    <div class=\"fields\">

      ";
        // line 91
        yield "      <div class=\"field\">
        <label for=\"";
        // line 92
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 92, $this->source); })()), "name", [], "any", false, false, false, 92), "vars", [], "any", false, false, false, 92), "id", [], "any", false, false, false, 92), "html", null, true);
        yield "\">Full Name</label>
        <div class=\"input-wrap\">
          <span class=\"input-icon\">
            <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2\"/><circle cx=\"12\" cy=\"7\" r=\"4\"/></svg>
          </span>
          ";
        // line 97
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 97, $this->source); })()), "name", [], "any", false, false, false, 97), 'widget', ["attr" => ["placeholder" => "Jane Doe", "class" => (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 100
(isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 100, $this->source); })()), "name", [], "any", false, false, false, 100), "vars", [], "any", false, false, false, 100), "valid", [], "any", false, false, false, 100)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("") : ("is-invalid"))]]);
        // line 102
        yield "
        </div>
        ";
        // line 104
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 104, $this->source); })()), "name", [], "any", false, false, false, 104), "vars", [], "any", false, false, false, 104), "valid", [], "any", false, false, false, 104)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 105
            yield "          <div class=\"field-error\">";
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 105, $this->source); })()), "name", [], "any", false, false, false, 105), 'errors');
            yield "</div>
        ";
        }
        // line 107
        yield "      </div>

      ";
        // line 110
        yield "      <div class=\"field\">
        <label for=\"";
        // line 111
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 111, $this->source); })()), "email", [], "any", false, false, false, 111), "vars", [], "any", false, false, false, 111), "id", [], "any", false, false, false, 111), "html", null, true);
        yield "\">Email Address</label>
        <div class=\"input-wrap\">
          <span class=\"input-icon\">
            <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z\"/><polyline points=\"22,6 12,13 2,6\"/></svg>
          </span>
          ";
        // line 116
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 116, $this->source); })()), "email", [], "any", false, false, false, 116), 'widget', ["attr" => ["placeholder" => "jane@example.com", "class" => (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 119
(isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 119, $this->source); })()), "email", [], "any", false, false, false, 119), "vars", [], "any", false, false, false, 119), "valid", [], "any", false, false, false, 119)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("") : ("is-invalid"))]]);
        // line 121
        yield "
        </div>
        ";
        // line 123
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 123, $this->source); })()), "email", [], "any", false, false, false, 123), "vars", [], "any", false, false, false, 123), "valid", [], "any", false, false, false, 123)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 124
            yield "          <div class=\"field-error\">";
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 124, $this->source); })()), "email", [], "any", false, false, false, 124), 'errors');
            yield "</div>
        ";
        }
        // line 126
        yield "      </div>

      ";
        // line 129
        yield "      <div class=\"row\">
        <div class=\"field\">
          <label for=\"";
        // line 131
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 131, $this->source); })()), "phone", [], "any", false, false, false, 131), "vars", [], "any", false, false, false, 131), "id", [], "any", false, false, false, 131), "html", null, true);
        yield "\">
            Phone <span class=\"opt-tag\">optional</span>
          </label>
          <div class=\"input-wrap\">
            <span class=\"input-icon\">
              <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.63 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.8a16 16 0 0 0 6.29 6.29l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z\"/></svg>
            </span>
            ";
        // line 138
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 138, $this->source); })()), "phone", [], "any", false, false, false, 138), 'widget', ["attr" => ["placeholder" => "12345678"]]);
        // line 140
        yield "
          </div>
          ";
        // line 142
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 142, $this->source); })()), "phone", [], "any", false, false, false, 142), "vars", [], "any", false, false, false, 142), "valid", [], "any", false, false, false, 142)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 143
            yield "            <div class=\"field-error\">";
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 143, $this->source); })()), "phone", [], "any", false, false, false, 143), 'errors');
            yield "</div>
          ";
        }
        // line 145
        yield "        </div>

        <div class=\"field\">
          <label for=\"";
        // line 148
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 148, $this->source); })()), "motorized", [], "any", false, false, false, 148), "vars", [], "any", false, false, false, 148), "id", [], "any", false, false, false, 148), "html", null, true);
        yield "\">Motorized</label>
          <div class=\"input-wrap\">
            <span class=\"input-icon\">
              <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><rect x=\"1\" y=\"3\" width=\"15\" height=\"13\" rx=\"2\"/><polygon points=\"16 8 20 8 23 11 23 16 16 16 16 8\"/><circle cx=\"5.5\" cy=\"18.5\" r=\"2.5\"/><circle cx=\"18.5\" cy=\"18.5\" r=\"2.5\"/></svg>
            </span>
            ";
        // line 153
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 153, $this->source); })()), "motorized", [], "any", false, false, false, 153), 'widget', ["attr" => ["style" => "padding-left:42px;"]]);
        // line 155
        yield "
          </div>
          ";
        // line 157
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 157, $this->source); })()), "motorized", [], "any", false, false, false, 157), "vars", [], "any", false, false, false, 157), "valid", [], "any", false, false, false, 157)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 158
            yield "            <div class=\"field-error\">";
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 158, $this->source); })()), "motorized", [], "any", false, false, false, 158), 'errors');
            yield "</div>
          ";
        }
        // line 160
        yield "        </div>
      </div>

      ";
        // line 164
        yield "      <div class=\"sep\"><span>Security</span></div>

      ";
        // line 167
        yield "      <div class=\"field\">
        <label for=\"";
        // line 168
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 168, $this->source); })()), "password", [], "any", false, false, false, 168), "vars", [], "any", false, false, false, 168), "id", [], "any", false, false, false, 168), "html", null, true);
        yield "\">Password</label>
        <div class=\"input-wrap\">
          <span class=\"input-icon\">
            <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><rect x=\"3\" y=\"11\" width=\"18\" height=\"11\" rx=\"2\" ry=\"2\"/><path d=\"M7 11V7a5 5 0 0 1 10 0v4\"/></svg>
          </span>
          ";
        // line 173
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 173, $this->source); })()), "password", [], "any", false, false, false, 173), 'widget', ["attr" => ["placeholder" => "Min. 6 characters", "oninput" => "checkStrength(this.value)", "id" => "password-field", "class" => (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 178
(isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 178, $this->source); })()), "password", [], "any", false, false, false, 178), "vars", [], "any", false, false, false, 178), "valid", [], "any", false, false, false, 178)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("") : ("is-invalid"))]]);
        // line 180
        yield "
          <button type=\"button\" class=\"eye\" onclick=\"togglePwd('password-field', this)\" aria-label=\"Toggle\">
            <svg id=\"eye-password-field\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\">
              <path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/>
            </svg>
          </button>
        </div>
        <div class=\"strength-bar\"><div class=\"strength-fill\" id=\"strength-fill\"></div></div>
        <div class=\"strength-label\" id=\"strength-label\">Enter a password</div>
        ";
        // line 189
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 189, $this->source); })()), "password", [], "any", false, false, false, 189), "vars", [], "any", false, false, false, 189), "valid", [], "any", false, false, false, 189)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 190
            yield "          <div class=\"field-error\">";
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 190, $this->source); })()), "password", [], "any", false, false, false, 190), 'errors');
            yield "</div>
        ";
        }
        // line 192
        yield "      </div>

      ";
        // line 195
        yield "      <div class=\"field\">
        <label for=\"confirm_password\">Confirm Password</label>
        <div class=\"input-wrap\">
          <span class=\"input-icon\">
            <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z\"/></svg>
          </span>
          <input type=\"password\" id=\"confirm_password\" name=\"confirm_password\" placeholder=\"Repeat password\" required/>
          <button type=\"button\" class=\"eye\" onclick=\"togglePwd('confirm_password', this)\" aria-label=\"Toggle\">
            <svg id=\"eye-confirm_password\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\">
              <path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/>
            </svg>
          </button>
        </div>
      </div>

    </div>";
        // line 211
        yield "
    <button type=\"submit\" class=\"btn-submit\" style=\"margin-top:28px;\">CREATE ACCOUNT</button>

  ";
        // line 214
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 214, $this->source); })()), 'form_end');
        yield "

  <div class=\"or-row\"><span>or sign up with</span></div>
  <div class=\"social-row\">
    <button type=\"button\" class=\"btn-social\">
      <svg width=\"17\" height=\"17\" viewBox=\"0 0 24 24\"><path fill=\"#4285F4\" d=\"M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z\"/><path fill=\"#34A853\" d=\"M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z\"/><path fill=\"#FBBC05\" d=\"M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z\"/><path fill=\"#EA4335\" d=\"M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z\"/></svg>
      Google
    </button>
    <button type=\"button\" class=\"btn-social\">
      <svg width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"currentColor\"><path d=\"M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z\"/></svg>
      Apple
    </button>
  </div>

  <p class=\"bottom-link\">Already have an account? <a href=\"";
        // line 228
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\">Sign In</a></p>

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 232
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_extra_scripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "extra_scripts"));

        // line 233
        yield "<script>
  document.addEventListener(\"DOMContentLoaded\", function () {

    const imageInput = document.getElementById('registration_form_imageFile');

    if (imageInput) {
        imageInput.addEventListener('change', function () {

            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();

            reader.onload = function (e) {
                const preview = document.getElementById('avatar-preview');

                preview.src = e.target.result;
                preview.style.borderColor = 'var(--teal)';
                preview.style.boxShadow = '0 0 0 3px rgba(46,207,184,0.2)';
            };

            reader.readAsDataURL(file);
        });
    }

});

  ";
        // line 261
        yield "  function togglePwd(id, btn) {
    const input = document.getElementById(id);
    const icon  = document.getElementById('eye-' + id);
    if (input.type === 'password') {
      input.type = 'text';
      icon.innerHTML = `<path d=\"M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24\"/><line x1=\"1\" y1=\"1\" x2=\"23\" y2=\"23\"/>`;
    } else {
      input.type = 'password';
      icon.innerHTML = `<path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/>`;
    }
  }

  ";
        // line 274
        yield "  function checkStrength(val) {
    const fill  = document.getElementById('strength-fill');
    const label = document.getElementById('strength-label');
    let score = 0;
    if (val.length >= 6)   score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[\\W_]/.test(val)) score++;
    const levels = [
      { w:'0%',   c:'transparent', t:'Enter a password' },
      { w:'25%',  c:'#e8392c',     t:'Weak' },
      { w:'50%',  c:'#f5a623',     t:'Fair' },
      { w:'75%',  c:'#f5c842',     t:'Good' },
      { w:'100%', c:'#2ecfb8',     t:'Strong ✓' },
    ];
    const lvl = levels[val.length === 0 ? 0 : score];
    fill.style.width      = lvl.w;
    fill.style.background = lvl.c;
    label.textContent     = val.length === 0 ? 'Enter a password' : lvl.t;
    label.style.color     = val.length === 0 ? 'var(--muted)' : lvl.c;
  }
</script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "security/register.html.twig";
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
        return array (  498 => 274,  484 => 261,  455 => 233,  445 => 232,  434 => 228,  417 => 214,  412 => 211,  395 => 195,  391 => 192,  385 => 190,  383 => 189,  372 => 180,  370 => 178,  369 => 173,  361 => 168,  358 => 167,  354 => 164,  349 => 160,  343 => 158,  341 => 157,  337 => 155,  335 => 153,  327 => 148,  322 => 145,  316 => 143,  314 => 142,  310 => 140,  308 => 138,  298 => 131,  294 => 129,  290 => 126,  284 => 124,  282 => 123,  278 => 121,  276 => 119,  275 => 116,  267 => 111,  264 => 110,  260 => 107,  254 => 105,  252 => 104,  248 => 102,  246 => 100,  245 => 97,  237 => 92,  234 => 91,  226 => 85,  223 => 84,  219 => 81,  216 => 76,  194 => 55,  186 => 48,  176 => 47,  147 => 24,  137 => 23,  128 => 20,  118 => 19,  107 => 14,  97 => 13,  80 => 11,  63 => 9,  46 => 7,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# templates/security/register.html.twig
   Registration page — extends base_auth.html.twig
   Controller must pass:
     - registrationForm: the Symfony form (created from RegistrationFormType)
   Route example: /register  (name: app_register)
#}
{% extends 'base_auth.html.twig' %}

{% block title %}Create Account{% endblock %}

{% block hero_eyebrow %}Nature &amp; Adventure{% endblock %}

{% block hero_title %}
  INTO<br/>
  THE<br/>
  <span class=\"outline\">WILD</span>
{% endblock %}

{% block hero_desc %}
  Where every trail leads to a new story. Join LAMMA and plan your next unforgettable camping adventure.
{% endblock %}

{% block extra_styles %}
  /* ── Avatar uploader ── */
  .avatar-section { display:flex; align-items:center; gap:20px; margin-bottom:36px; padding-bottom:36px; border-bottom:1px solid var(--line); }
  .avatar-ring { position:relative; flex-shrink:0; }
  .avatar-preview { width:86px; height:86px; border-radius:50%; background:var(--surface); border:2px solid var(--line); object-fit:cover; display:block; transition:border-color .3s; }
  .avatar-ring:hover .avatar-preview { border-color:var(--teal); }
  .avatar-edit { position:absolute; bottom:0; right:0; width:26px; height:26px; border-radius:50%; background:var(--red); border:2px solid var(--card); display:grid; place-items:center; cursor:pointer; transition:background .2s,transform .2s; }
  .avatar-edit:hover { background:#c42e23; transform:scale(1.1); }
  .avatar-edit svg { width:12px; height:12px; }
  .avatar-info h3 { font-size:.95rem; font-weight:600; margin-bottom:4px; }
  .avatar-info p { font-size:.78rem; color:var(--muted); line-height:1.5; }
  .avatar-btn { display:inline-block; margin-top:8px; font-size:.75rem; font-weight:600; letter-spacing:.06em; color:var(--teal); cursor:pointer; background:none; border:none; padding:0; transition:opacity .2s; }
  .avatar-btn:hover { opacity:.7; }

  /* ── Password strength ── */
  .strength-bar { height:2px; background:var(--line); border-radius:2px; overflow:hidden; margin-top:8px; }
  .strength-fill { height:100%; width:0%; border-radius:2px; transition:width .4s,background .4s; }
  .strength-label { font-size:.68rem; color:var(--muted); margin-top:4px; }

  /* ── Inline field errors ── */
  .field-error { font-size:.72rem; color:#ff8a80; margin-top:4px; }
  input.is-invalid, select.is-invalid { border-color:#e8392c !important; }
{% endblock %}

{% block form_content %}

  <div class=\"form-header\">
    <h1>Create Account</h1>
    <p>Join LAMMA and start planning your next camping adventure in the wild.</p>
  </div>

  {# ── Profile photo uploader ── #}
  <div class=\"avatar-section\">
    <div class=\"avatar-ring\">
      <img id=\"avatar-preview\" class=\"avatar-preview\"
        src=\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 86 86'%3E%3Crect width='86' height='86' fill='%230f0f11'/%3E%3Ccircle cx='43' cy='34' r='16' fill='%23222'/%3E%3Cellipse cx='43' cy='72' rx='26' ry='18' fill='%23222'/%3E%3C/svg%3E\"
        alt=\"Profile preview\"/>
      <label for=\"registration_form_imageFile\" class=\"avatar-edit\" title=\"Upload photo\">
        <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"white\" stroke-width=\"2.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
          <path d=\"M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4\"/>
          <polyline points=\"17 8 12 3 7 8\"/>
          <line x1=\"12\" y1=\"3\" x2=\"12\" y2=\"15\"/>
        </svg>
      </label>
    </div>
    <div class=\"avatar-info\">
      <h3>Profile Photo</h3>
      <p>PNG, JPG or WEBP · Max 2 MB</p>
      <button type=\"button\" class=\"avatar-btn\" onclick=\"document.getElementById('registration_form_imageFile').click()\">Upload photo →</button>
    </div>
  </div>

  {# ── Symfony form ── #}
  {{ form_start(registrationForm, {
    'action': path('app_register'),
    'method': 'POST',
    'attr': {'novalidate': 'novalidate', 'id':'register-form'},
    'multipart': true
}) }}

    {# Hidden image field rendered by Symfony (we use custom label above) #}
    <div style=\"display:none\">
      {{ form_widget(registrationForm.imageFile) }}
    </div>

    <div class=\"fields\">

      {# Full Name #}
      <div class=\"field\">
        <label for=\"{{ registrationForm.name.vars.id }}\">Full Name</label>
        <div class=\"input-wrap\">
          <span class=\"input-icon\">
            <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2\"/><circle cx=\"12\" cy=\"7\" r=\"4\"/></svg>
          </span>
          {{ form_widget(registrationForm.name, {
            'attr': {
              'placeholder': 'Jane Doe',
              'class': registrationForm.name.vars.valid ? '' : 'is-invalid'
            }
          }) }}
        </div>
        {% if not registrationForm.name.vars.valid %}
          <div class=\"field-error\">{{ form_errors(registrationForm.name) }}</div>
        {% endif %}
      </div>

      {# Email #}
      <div class=\"field\">
        <label for=\"{{ registrationForm.email.vars.id }}\">Email Address</label>
        <div class=\"input-wrap\">
          <span class=\"input-icon\">
            <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z\"/><polyline points=\"22,6 12,13 2,6\"/></svg>
          </span>
          {{ form_widget(registrationForm.email, {
            'attr': {
              'placeholder': 'jane@example.com',
              'class': registrationForm.email.vars.valid ? '' : 'is-invalid'
            }
          }) }}
        </div>
        {% if not registrationForm.email.vars.valid %}
          <div class=\"field-error\">{{ form_errors(registrationForm.email) }}</div>
        {% endif %}
      </div>

      {# Phone + Motorized ─ side by side #}
      <div class=\"row\">
        <div class=\"field\">
          <label for=\"{{ registrationForm.phone.vars.id }}\">
            Phone <span class=\"opt-tag\">optional</span>
          </label>
          <div class=\"input-wrap\">
            <span class=\"input-icon\">
              <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.63 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.8a16 16 0 0 0 6.29 6.29l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z\"/></svg>
            </span>
            {{ form_widget(registrationForm.phone, {
              'attr': { 'placeholder': '12345678' }
            }) }}
          </div>
          {% if not registrationForm.phone.vars.valid %}
            <div class=\"field-error\">{{ form_errors(registrationForm.phone) }}</div>
          {% endif %}
        </div>

        <div class=\"field\">
          <label for=\"{{ registrationForm.motorized.vars.id }}\">Motorized</label>
          <div class=\"input-wrap\">
            <span class=\"input-icon\">
              <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><rect x=\"1\" y=\"3\" width=\"15\" height=\"13\" rx=\"2\"/><polygon points=\"16 8 20 8 23 11 23 16 16 16 16 8\"/><circle cx=\"5.5\" cy=\"18.5\" r=\"2.5\"/><circle cx=\"18.5\" cy=\"18.5\" r=\"2.5\"/></svg>
            </span>
            {{ form_widget(registrationForm.motorized, {
              'attr': { 'style': 'padding-left:42px;' }
            }) }}
          </div>
          {% if not registrationForm.motorized.vars.valid %}
            <div class=\"field-error\">{{ form_errors(registrationForm.motorized) }}</div>
          {% endif %}
        </div>
      </div>

      {# Security divider #}
      <div class=\"sep\"><span>Security</span></div>

      {# Password #}
      <div class=\"field\">
        <label for=\"{{ registrationForm.password.vars.id }}\">Password</label>
        <div class=\"input-wrap\">
          <span class=\"input-icon\">
            <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><rect x=\"3\" y=\"11\" width=\"18\" height=\"11\" rx=\"2\" ry=\"2\"/><path d=\"M7 11V7a5 5 0 0 1 10 0v4\"/></svg>
          </span>
          {{ form_widget(registrationForm.password, {
            'attr': {
              'placeholder': 'Min. 6 characters',
              'oninput': 'checkStrength(this.value)',
              'id': 'password-field',
              'class': registrationForm.password.vars.valid ? '' : 'is-invalid'
            }
          }) }}
          <button type=\"button\" class=\"eye\" onclick=\"togglePwd('password-field', this)\" aria-label=\"Toggle\">
            <svg id=\"eye-password-field\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\">
              <path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/>
            </svg>
          </button>
        </div>
        <div class=\"strength-bar\"><div class=\"strength-fill\" id=\"strength-fill\"></div></div>
        <div class=\"strength-label\" id=\"strength-label\">Enter a password</div>
        {% if not registrationForm.password.vars.valid %}
          <div class=\"field-error\">{{ form_errors(registrationForm.password) }}</div>
        {% endif %}
      </div>

      {# Confirm Password — plain field, validated server-side or with JS #}
      <div class=\"field\">
        <label for=\"confirm_password\">Confirm Password</label>
        <div class=\"input-wrap\">
          <span class=\"input-icon\">
            <svg width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z\"/></svg>
          </span>
          <input type=\"password\" id=\"confirm_password\" name=\"confirm_password\" placeholder=\"Repeat password\" required/>
          <button type=\"button\" class=\"eye\" onclick=\"togglePwd('confirm_password', this)\" aria-label=\"Toggle\">
            <svg id=\"eye-confirm_password\" width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\">
              <path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/>
            </svg>
          </button>
        </div>
      </div>

    </div>{# /fields #}

    <button type=\"submit\" class=\"btn-submit\" style=\"margin-top:28px;\">CREATE ACCOUNT</button>

  {{ form_end(registrationForm) }}

  <div class=\"or-row\"><span>or sign up with</span></div>
  <div class=\"social-row\">
    <button type=\"button\" class=\"btn-social\">
      <svg width=\"17\" height=\"17\" viewBox=\"0 0 24 24\"><path fill=\"#4285F4\" d=\"M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z\"/><path fill=\"#34A853\" d=\"M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z\"/><path fill=\"#FBBC05\" d=\"M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z\"/><path fill=\"#EA4335\" d=\"M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z\"/></svg>
      Google
    </button>
    <button type=\"button\" class=\"btn-social\">
      <svg width=\"17\" height=\"17\" viewBox=\"0 0 24 24\" fill=\"currentColor\"><path d=\"M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z\"/></svg>
      Apple
    </button>
  </div>

  <p class=\"bottom-link\">Already have an account? <a href=\"{{ path('app_login') }}\">Sign In</a></p>

{% endblock %}

{% block extra_scripts %}
<script>
  document.addEventListener(\"DOMContentLoaded\", function () {

    const imageInput = document.getElementById('registration_form_imageFile');

    if (imageInput) {
        imageInput.addEventListener('change', function () {

            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();

            reader.onload = function (e) {
                const preview = document.getElementById('avatar-preview');

                preview.src = e.target.result;
                preview.style.borderColor = 'var(--teal)';
                preview.style.boxShadow = '0 0 0 3px rgba(46,207,184,0.2)';
            };

            reader.readAsDataURL(file);
        });
    }

});

  {# ── Password toggle ── #}
  function togglePwd(id, btn) {
    const input = document.getElementById(id);
    const icon  = document.getElementById('eye-' + id);
    if (input.type === 'password') {
      input.type = 'text';
      icon.innerHTML = `<path d=\"M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24\"/><line x1=\"1\" y1=\"1\" x2=\"23\" y2=\"23\"/>`;
    } else {
      input.type = 'password';
      icon.innerHTML = `<path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/>`;
    }
  }

  {# ── Password strength ── #}
  function checkStrength(val) {
    const fill  = document.getElementById('strength-fill');
    const label = document.getElementById('strength-label');
    let score = 0;
    if (val.length >= 6)   score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[\\W_]/.test(val)) score++;
    const levels = [
      { w:'0%',   c:'transparent', t:'Enter a password' },
      { w:'25%',  c:'#e8392c',     t:'Weak' },
      { w:'50%',  c:'#f5a623',     t:'Fair' },
      { w:'75%',  c:'#f5c842',     t:'Good' },
      { w:'100%', c:'#2ecfb8',     t:'Strong ✓' },
    ];
    const lvl = levels[val.length === 0 ? 0 : score];
    fill.style.width      = lvl.w;
    fill.style.background = lvl.c;
    label.textContent     = val.length === 0 ? 'Enter a password' : lvl.t;
    label.style.color     = val.length === 0 ? 'var(--muted)' : lvl.c;
  }
</script>
{% endblock %}
", "security/register.html.twig", "C:\\Users\\saifl\\OneDrive\\Desktop\\back_saif2\\user_symfony_saif\\user_saif\\templates\\security\\register.html.twig");
    }
}
