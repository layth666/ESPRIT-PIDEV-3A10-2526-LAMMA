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

/* security/access_denied.html.twig */
class __TwigTemplate_7c5a21b9820ebaafecfdaa3b19dfdd9e extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/access_denied.html.twig"));

        // line 2
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta charset=\"UTF-8\"/>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
  <title>LAMMA — Access Denied</title>
  <link href=\"https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap\" rel=\"stylesheet\"/>
  <style>
    :root{--red:#e8392c;--teal:#2ecfb8;--dark:#080809;--surface:#0f0f11;--card:#141416;--line:rgba(255,255,255,0.07);--muted:rgba(255,255,255,0.38);--soft:rgba(255,255,255,0.65);--white:#ffffff;}
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    html,body{height:100%;background:var(--dark);color:var(--white);font-family:'DM Sans',sans-serif;display:grid;place-items:center;}
    body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 100%,rgba(232,57,44,0.18) 0%,transparent 65%);pointer-events:none;}
    .card{position:relative;z-index:1;background:var(--card);border:1px solid var(--line);border-radius:20px;padding:52px 48px;max-width:460px;width:90%;text-align:center;box-shadow:0 32px 80px rgba(0,0,0,.5);animation:popIn .5s cubic-bezier(.34,1.56,.64,1);}
    @keyframes popIn{from{opacity:0;transform:scale(.92) translateY(20px)}to{opacity:1;transform:none}}
    .brand{display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:28px;}
    .brand img{width:32px;height:32px;object-fit:contain;border-radius:6px;}
    .brand-name{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:.12em;}
    .brand-name span{color:var(--red);}
    .icon-wrap{width:80px;height:80px;border-radius:50%;background:rgba(232,57,44,.1);border:2px solid rgba(232,57,44,.25);display:grid;place-items:center;margin:0 auto 24px;}
    .icon-wrap svg{width:36px;height:36px;stroke:var(--red);}
    h1{font-family:'Bebas Neue',sans-serif;font-size:2.6rem;letter-spacing:.06em;margin-bottom:12px;}
    .subtitle{font-size:.95rem;color:var(--muted);line-height:1.7;margin-bottom:32px;}
    .subtitle strong{color:var(--white);font-weight:600;}
    .divider{height:1px;background:var(--line);margin:24px 0;}
    .info-box{background:var(--surface);border:1px solid var(--line);border-radius:10px;padding:16px 20px;text-align:left;font-size:.82rem;color:var(--muted);line-height:1.7;}
    .info-box strong{color:var(--soft);}
    .btn-back{display:inline-flex;align-items:center;gap:8px;margin-top:28px;padding:13px 28px;background:var(--surface);border:1px solid var(--line);border-radius:8px;color:var(--soft);font-family:'DM Sans',sans-serif;font-size:.9rem;font-weight:600;text-decoration:none;transition:border-color .2s,background .2s,color .2s;}
    .btn-back:hover{border-color:rgba(255,255,255,.2);background:rgba(255,255,255,.05);color:var(--white);}
    .btn-back svg{width:16px;height:16px;}
  </style>
</head>
<body>
  <div class=\"card\">
    <div class=\"brand\">
      <img src=\"";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/logo.png"), "html", null, true);
        yield "\" alt=\"LAMMA\"/>
      <div class=\"brand-name\">LAMMA<span>.</span></div>
    </div>
    <div class=\"icon-wrap\">
      <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke-width=\"2\" stroke-linecap=\"round\">
        <rect x=\"3\" y=\"11\" width=\"18\" height=\"11\" rx=\"2\"/><path d=\"M7 11V7a5 5 0 0 1 10 0v4\"/>
      </svg>
    </div>
    <h1>Access Denied</h1>
    <p class=\"subtitle\">You don't have <strong>administrator privileges</strong> to access this area of the platform.</p>
    <div class=\"divider\"></div>
    <div class=\"info-box\">
      <strong>Why am I seeing this?</strong><br/>
      This section is restricted to administrators only. If you believe you should have access, please contact your platform administrator.
    </div>
    <a href=\"";
        // line 51
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\" class=\"btn-back\">
      <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><line x1=\"19\" y1=\"12\" x2=\"5\" y2=\"12\"/><polyline points=\"12 19 5 12 12 5\"/></svg>
      Back to Login
    </a>
  </div>
</body>
</html>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "security/access_denied.html.twig";
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
        return array (  99 => 51,  81 => 36,  45 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# templates/security/access_denied.html.twig #}
<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta charset=\"UTF-8\"/>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
  <title>LAMMA — Access Denied</title>
  <link href=\"https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap\" rel=\"stylesheet\"/>
  <style>
    :root{--red:#e8392c;--teal:#2ecfb8;--dark:#080809;--surface:#0f0f11;--card:#141416;--line:rgba(255,255,255,0.07);--muted:rgba(255,255,255,0.38);--soft:rgba(255,255,255,0.65);--white:#ffffff;}
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    html,body{height:100%;background:var(--dark);color:var(--white);font-family:'DM Sans',sans-serif;display:grid;place-items:center;}
    body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 100%,rgba(232,57,44,0.18) 0%,transparent 65%);pointer-events:none;}
    .card{position:relative;z-index:1;background:var(--card);border:1px solid var(--line);border-radius:20px;padding:52px 48px;max-width:460px;width:90%;text-align:center;box-shadow:0 32px 80px rgba(0,0,0,.5);animation:popIn .5s cubic-bezier(.34,1.56,.64,1);}
    @keyframes popIn{from{opacity:0;transform:scale(.92) translateY(20px)}to{opacity:1;transform:none}}
    .brand{display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:28px;}
    .brand img{width:32px;height:32px;object-fit:contain;border-radius:6px;}
    .brand-name{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:.12em;}
    .brand-name span{color:var(--red);}
    .icon-wrap{width:80px;height:80px;border-radius:50%;background:rgba(232,57,44,.1);border:2px solid rgba(232,57,44,.25);display:grid;place-items:center;margin:0 auto 24px;}
    .icon-wrap svg{width:36px;height:36px;stroke:var(--red);}
    h1{font-family:'Bebas Neue',sans-serif;font-size:2.6rem;letter-spacing:.06em;margin-bottom:12px;}
    .subtitle{font-size:.95rem;color:var(--muted);line-height:1.7;margin-bottom:32px;}
    .subtitle strong{color:var(--white);font-weight:600;}
    .divider{height:1px;background:var(--line);margin:24px 0;}
    .info-box{background:var(--surface);border:1px solid var(--line);border-radius:10px;padding:16px 20px;text-align:left;font-size:.82rem;color:var(--muted);line-height:1.7;}
    .info-box strong{color:var(--soft);}
    .btn-back{display:inline-flex;align-items:center;gap:8px;margin-top:28px;padding:13px 28px;background:var(--surface);border:1px solid var(--line);border-radius:8px;color:var(--soft);font-family:'DM Sans',sans-serif;font-size:.9rem;font-weight:600;text-decoration:none;transition:border-color .2s,background .2s,color .2s;}
    .btn-back:hover{border-color:rgba(255,255,255,.2);background:rgba(255,255,255,.05);color:var(--white);}
    .btn-back svg{width:16px;height:16px;}
  </style>
</head>
<body>
  <div class=\"card\">
    <div class=\"brand\">
      <img src=\"{{ asset('images/logo.png') }}\" alt=\"LAMMA\"/>
      <div class=\"brand-name\">LAMMA<span>.</span></div>
    </div>
    <div class=\"icon-wrap\">
      <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke-width=\"2\" stroke-linecap=\"round\">
        <rect x=\"3\" y=\"11\" width=\"18\" height=\"11\" rx=\"2\"/><path d=\"M7 11V7a5 5 0 0 1 10 0v4\"/>
      </svg>
    </div>
    <h1>Access Denied</h1>
    <p class=\"subtitle\">You don't have <strong>administrator privileges</strong> to access this area of the platform.</p>
    <div class=\"divider\"></div>
    <div class=\"info-box\">
      <strong>Why am I seeing this?</strong><br/>
      This section is restricted to administrators only. If you believe you should have access, please contact your platform administrator.
    </div>
    <a href=\"{{ path('app_login') }}\" class=\"btn-back\">
      <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><line x1=\"19\" y1=\"12\" x2=\"5\" y2=\"12\"/><polyline points=\"12 19 5 12 12 5\"/></svg>
      Back to Login
    </a>
  </div>
</body>
</html>
", "security/access_denied.html.twig", "C:\\Users\\saifl\\OneDrive\\Desktop\\back_saif2\\user_symfony_saif\\user_saif\\templates\\security\\access_denied.html.twig");
    }
}
