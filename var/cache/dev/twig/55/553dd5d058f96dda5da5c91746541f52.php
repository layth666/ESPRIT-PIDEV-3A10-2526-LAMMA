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

/* profile/index.html.twig */
class __TwigTemplate_61a7b71689e1f713a97dfb791e4b99f3 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "profile/index.html.twig"));

        // line 7
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta charset=\"UTF-8\"/>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
  <title>LAMMA — My Profile</title>
  <link href=\"https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap\" rel=\"stylesheet\"/>
  <style>
    :root {
      --red:     #e8392c;
      --teal:    #2ecfb8;
      --yellow:  #f5c842;
      --dark:    #080809;
      --surface: #0f0f11;
      --card:    #141416;
      --line:    rgba(255,255,255,0.07);
      --muted:   rgba(255,255,255,0.38);
      --soft:    rgba(255,255,255,0.65);
      --white:   #ffffff;
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    html,body{height:100%;background:var(--dark);color:var(--white);font-family:'DM Sans',sans-serif;overflow:hidden;}

    .page{display:grid;grid-template-columns:1fr 1fr;height:100vh;}

    /* ══ LEFT PANEL ══ */
    .visual{position:relative;overflow:hidden;background:var(--surface);display:flex;flex-direction:column;justify-content:space-between;padding:44px 52px;}
    .visual::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 90% 55% at 30% 100%,rgba(232,57,44,0.40) 0%,transparent 60%),radial-gradient(ellipse 60% 45% at 85% 5%,rgba(46,207,184,0.22) 0%,transparent 55%);pointer-events:none;}
    .visual::after{content:'';position:absolute;inset:0;background-image:url(\"data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E\");background-size:200px;opacity:.6;pointer-events:none;}

    .beams{position:absolute;inset:0;pointer-events:none;overflow:hidden;}
    .beam{position:absolute;bottom:-10px;width:1.5px;background:linear-gradient(to top,rgba(255,255,255,0.13),transparent);animation:pulse 5s ease-in-out infinite alternate;}
    .beam:nth-child(1){left:15%;height:70%;transform:rotate(-18deg);animation-delay:0s;}
    .beam:nth-child(2){left:28%;height:82%;transform:rotate(-7deg);animation-delay:.9s;background:linear-gradient(to top,rgba(46,207,184,0.18),transparent);}
    .beam:nth-child(3){left:45%;height:95%;transform:rotate(0deg);animation-delay:1.7s;}
    .beam:nth-child(4){left:63%;height:68%;transform:rotate(9deg);animation-delay:.4s;background:linear-gradient(to top,rgba(232,57,44,0.18),transparent);}
    .beam:nth-child(5){left:79%;height:78%;transform:rotate(17deg);animation-delay:1.2s;}
    @keyframes pulse{0%{opacity:.4}100%{opacity:1}}

    .blob{position:absolute;border-radius:50%;filter:blur(1px);}
    .blob-1{width:180px;height:180px;background:var(--yellow);bottom:80px;left:-60px;opacity:.78;animation:drift 8s ease-in-out infinite alternate;}
    .blob-2{width:130px;height:155px;border-radius:50% 50% 50% 10%;background:var(--teal);top:50px;right:-40px;opacity:.82;animation:drift 10s ease-in-out infinite alternate-reverse;}
    @keyframes drift{0%{transform:translateY(0) rotate(0deg)}100%{transform:translateY(16px) rotate(6deg)}}

    .brand{position:relative;z-index:2;display:flex;align-items:center;gap:10px;}
    .brand-logo{width:44px;height:44px;object-fit:contain;border-radius:6px;filter:drop-shadow(0 2px 6px rgba(0,0,0,0.5));}
    .brand-name{font-family:'Bebas Neue',sans-serif;font-size:1.9rem;letter-spacing:.12em;color:var(--white);line-height:1;}
    .brand-name span{color:var(--red);}

    /* Identity card */
    .identity{position:relative;z-index:2;display:flex;flex-direction:column;align-items:center;text-align:center;}
    .id-avatar-wrap{position:relative;margin-bottom:20px;}
    .id-avatar{width:110px;height:110px;border-radius:50%;object-fit:cover;border:3px solid rgba(255,255,255,.15);display:block;}
    .id-avatar-init{width:110px;height:110px;border-radius:50%;background:var(--red);border:3px solid rgba(232,57,44,.3);display:grid;place-items:center;font-family:'Bebas Neue',sans-serif;font-size:2.8rem;color:var(--white);}
    .id-name{font-family:'Bebas Neue',sans-serif;font-size:2rem;letter-spacing:.06em;margin-bottom:4px;}
    .id-email{font-size:.82rem;color:var(--muted);margin-bottom:12px;}
    .id-role{display:inline-flex;align-items:center;gap:5px;padding:4px 14px;border-radius:20px;font-size:.68rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;}
    .role-user{background:rgba(245,200,66,.12);color:var(--yellow);}
    .role-admin{background:rgba(232,57,44,.12);color:var(--red);}

    .id-stats{display:flex;gap:28px;margin-top:28px;}
    .id-stat{text-align:center;}
    .id-stat-num{font-family:'Bebas Neue',sans-serif;font-size:1.6rem;letter-spacing:.04em;}
    .id-stat-lbl{font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);}
    .id-stat-div{width:1px;background:var(--line);align-self:stretch;}

    .left-footer{position:relative;z-index:2;}
    .logout-link{display:inline-flex;align-items:center;gap:7px;font-size:.8rem;font-weight:600;color:var(--muted);text-decoration:none;padding:8px 14px;border:1px solid var(--line);border-radius:8px;transition:all .2s;}
    .logout-link:hover{color:var(--white);border-color:rgba(255,255,255,.2);background:rgba(255,255,255,.04);}
    .logout-link svg{width:15px;height:15px;}

    /* ══ RIGHT PANEL ══ */
    .form-panel{background:var(--card);overflow-y:auto;display:flex;align-items:flex-start;justify-content:center;padding:44px 52px;position:relative;}
    .form-panel::before{content:'';position:absolute;top:0;right:0;width:280px;height:280px;background:radial-gradient(circle,rgba(46,207,184,0.06) 0%,transparent 70%);pointer-events:none;}
    .form-panel::-webkit-scrollbar{width:4px;}
    .form-panel::-webkit-scrollbar-thumb{background:var(--line);}
    .form-inner{width:100%;max-width:440px;padding-bottom:24px;}

    .form-header{margin-bottom:32px;}
    .form-header h1{font-family:'Bebas Neue',sans-serif;font-size:2.4rem;letter-spacing:.08em;margin-bottom:6px;}
    .form-header p{font-size:.85rem;color:var(--muted);line-height:1.6;}

    /* flash messages */
    .flash{padding:11px 16px;border-radius:8px;font-size:.83rem;margin-bottom:12px;border:1px solid;display:flex;align-items:center;gap:9px;}
    .flash-success{background:rgba(46,207,184,.08);border-color:rgba(46,207,184,.25);color:var(--teal);}
    .flash-error{background:rgba(232,57,44,.08);border-color:rgba(232,57,44,.25);color:#ff8a80;}
    .flash svg{width:15px;height:15px;flex-shrink:0;}

    /* sections */
    .section{background:var(--surface);border:1px solid var(--line);border-radius:12px;padding:22px 22px 20px;margin-bottom:16px;}
    .section-title{font-size:.68rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--muted);margin-bottom:16px;display:flex;align-items:center;gap:8px;}
    .section-title::after{content:'';flex:1;height:1px;background:var(--line);}

    /* photo section */
    .photo-row{display:flex;align-items:center;gap:16px;}
    .photo-preview{width:64px;height:64px;border-radius:50%;object-fit:cover;border:2px solid var(--line);flex-shrink:0;}
    .photo-init{width:64px;height:64px;border-radius:50%;background:var(--red);border:2px solid rgba(232,57,44,.3);display:grid;place-items:center;font-family:'Bebas Neue',sans-serif;font-size:1.5rem;color:var(--white);flex-shrink:0;}
    .photo-info p{font-size:.78rem;color:var(--muted);margin-bottom:6px;}
    .photo-btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:7px;background:var(--card);border:1px solid var(--line);color:var(--soft);font-family:'DM Sans',sans-serif;font-size:.8rem;font-weight:600;cursor:pointer;transition:all .2s;}
    .photo-btn:hover{border-color:rgba(255,255,255,.2);color:var(--white);}
    .photo-btn svg{width:13px;height:13px;}

    /* fields */
    .field{display:flex;flex-direction:column;gap:6px;margin-bottom:14px;}
    .field:last-child{margin-bottom:0;}
    label{font-size:.68rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);}
    .input-wrap{position:relative;}
    .input-icon{position:absolute;left:13px;top:50%;transform:translateY(-50%);pointer-events:none;color:var(--muted);display:flex;}
    .input-icon svg{width:14px;height:14px;}
    input[type=\"text\"],input[type=\"email\"],input[type=\"password\"],input[type=\"tel\"]{width:100%;background:var(--card);border:1px solid var(--line);border-radius:8px;padding:12px 13px 12px 38px;font-family:'DM Sans',sans-serif;font-size:.88rem;color:var(--white);outline:none;transition:border-color .2s,box-shadow .2s,background .2s;}
    input::placeholder{color:rgba(255,255,255,.2);}
    input:focus{border-color:var(--teal);background:rgba(46,207,184,.05);box-shadow:0 0 0 3px rgba(46,207,184,.1);}
    input:disabled{opacity:.45;cursor:not-allowed;}
    .eye{position:absolute;right:11px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--muted);display:flex;transition:color .2s;}
    .eye:hover{color:var(--white);}
    .eye svg{width:15px;height:15px;}

    .field-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;}

    /* strength bar */
    .sbar{height:2px;background:var(--line);border-radius:2px;overflow:hidden;margin-top:6px;}
    .sfill{height:100%;width:0;border-radius:2px;transition:width .4s,background .4s;}
    .slbl{font-size:.65rem;color:var(--muted);margin-top:3px;}

    /* submit */
    .btn-save{width:100%;margin-top:16px;padding:13px;background:var(--red);border:none;border-radius:8px;font-family:'Bebas Neue',sans-serif;font-size:1.05rem;letter-spacing:.12em;color:var(--white);cursor:pointer;transition:background .2s,transform .15s,box-shadow .2s;}
    .btn-save:hover{background:#c93228;transform:translateY(-1px);box-shadow:0 8px 24px rgba(232,57,44,.3);}
    .btn-save:active{transform:translateY(0);}

    @media(max-width:900px){html,body{overflow:auto;}.page{grid-template-columns:1fr;height:auto;}.visual{min-height:320px;}.form-panel{padding:36px 24px;}.field-row{grid-template-columns:1fr;}}
  </style>
</head>
<body>
<div class=\"page\">

  ";
        // line 143
        yield "  <div class=\"visual\">
    <div class=\"beams\"><div class=\"beam\"></div><div class=\"beam\"></div><div class=\"beam\"></div><div class=\"beam\"></div><div class=\"beam\"></div></div>
    <div class=\"blob blob-1\"></div>
    <div class=\"blob blob-2\"></div>

    <div class=\"brand\">
      <img src=\"";
        // line 149
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/logo.png"), "html", null, true);
        yield "\" alt=\"LAMMA\" class=\"brand-logo\"/>
      <div class=\"brand-name\">LAMMA<span>.</span></div>
    </div>

    <div class=\"identity\">
      <div class=\"id-avatar-wrap\">
        ";
        // line 155
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 155, $this->source); })()), "image", [], "any", false, false, false, 155)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 156
            yield "          <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/images/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 156, $this->source); })()), "image", [], "any", false, false, false, 156))), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 156, $this->source); })()), "name", [], "any", false, false, false, 156), "html", null, true);
            yield "\" class=\"id-avatar\"/>
        ";
        } else {
            // line 158
            yield "          <div class=\"id-avatar-init\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 158, $this->source); })()), "name", [], "any", false, false, false, 158), 0, 1)), "html", null, true);
            yield "</div>
        ";
        }
        // line 160
        yield "      </div>
      <div class=\"id-name\">";
        // line 161
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 161, $this->source); })()), "name", [], "any", false, false, false, 161), "html", null, true);
        yield "</div>
      <div class=\"id-email\">";
        // line 162
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 162, $this->source); })()), "email", [], "any", false, false, false, 162), "html", null, true);
        yield "</div>
      <span class=\"id-role ";
        // line 163
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 163, $this->source); })()), "role", [], "any", false, false, false, 163) == "ADMIN")) ? ("role-admin") : ("role-user"));
        yield "\">
        ";
        // line 164
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 164, $this->source); })()), "role", [], "any", false, false, false, 164) == "ADMIN")) {
            // line 165
            yield "          <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.5\" stroke-linecap=\"round\" width=\"10\" height=\"10\"><path d=\"M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z\"/></svg>
        ";
        }
        // line 167
        yield "        ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 167, $this->source); })()), "role", [], "any", false, false, false, 167), "html", null, true);
        yield "
      </span>
      <div class=\"id-stats\">
        <div class=\"id-stat\">
          <div class=\"id-stat-num\">";
        // line 171
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "phone", [], "any", true, true, false, 171) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 171, $this->source); })()), "phone", [], "any", false, false, false, 171)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 171, $this->source); })()), "phone", [], "any", false, false, false, 171), "html", null, true)) : ("—"));
        yield "</div>
          <div class=\"id-stat-lbl\">Phone</div>
        </div>
        <div class=\"id-stat-div\"></div>
        <div class=\"id-stat\">
          <div class=\"id-stat-num\">";
        // line 176
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "motorized", [], "any", true, true, false, 176) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 176, $this->source); })()), "motorized", [], "any", false, false, false, 176)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 176, $this->source); })()), "motorized", [], "any", false, false, false, 176), "html", null, true)) : ("—"));
        yield "</div>
          <div class=\"id-stat-lbl\">Motorized</div>
        </div>
      </div>
    </div>

    <div class=\"left-footer\">
      <a href=\"";
        // line 183
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\" class=\"logout-link\">
        <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4\"/><polyline points=\"16 17 21 12 16 7\"/><line x1=\"21\" y1=\"12\" x2=\"9\" y2=\"12\"/></svg>
        Sign Out
      </a>
    </div>
  </div>

  ";
        // line 191
        yield "  <div class=\"form-panel\">
    <div class=\"form-inner\">

      <div class=\"form-header\">
        <h1>My Profile</h1>
        <p>Manage your personal information and account security.</p>
      </div>

      ";
        // line 200
        yield "      ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 200, $this->source); })()), "flashes", [], "any", false, false, false, 200));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 201
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 202
                yield "          <div class=\"flash flash-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield "\">
            ";
                // line 203
                if (($context["label"] == "success")) {
                    // line 204
                    yield "              <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.5\" stroke-linecap=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg>
            ";
                } else {
                    // line 206
                    yield "              <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.5\" stroke-linecap=\"round\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><line x1=\"15\" y1=\"9\" x2=\"9\" y2=\"15\"/><line x1=\"9\" y1=\"9\" x2=\"15\" y2=\"15\"/></svg>
            ";
                }
                // line 208
                yield "            ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
          </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 211
            yield "      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 212
        yield "
      ";
        // line 214
        yield "      <div class=\"section\">
        <div class=\"section-title\">Profile Photo</div>
        <div class=\"photo-row\">
          ";
        // line 217
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 217, $this->source); })()), "image", [], "any", false, false, false, 217)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 218
            yield "            <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/images/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 218, $this->source); })()), "image", [], "any", false, false, false, 218))), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 218, $this->source); })()), "name", [], "any", false, false, false, 218), "html", null, true);
            yield "\" class=\"photo-preview\" id=\"photoPreview\"/>
          ";
        } else {
            // line 220
            yield "            <div class=\"photo-init\" id=\"photoInit\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 220, $this->source); })()), "name", [], "any", false, false, false, 220), 0, 1)), "html", null, true);
            yield "</div>
          ";
        }
        // line 222
        yield "          <div class=\"photo-info\">
            <p>PNG, JPG or WEBP · Max 2 MB</p>
            <form action=\"";
        // line 224
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile_update_photo");
        yield "\" method=\"POST\" enctype=\"multipart/form-data\" id=\"photoForm\">
              <input type=\"file\" name=\"image\" id=\"photoInput\" accept=\"image/*\" style=\"display:none\" onchange=\"previewPhoto(this)\"/>
              <button type=\"button\" class=\"photo-btn\" onclick=\"document.getElementById('photoInput').click()\">
                <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4\"/><polyline points=\"17 8 12 3 7 8\"/><line x1=\"12\" y1=\"3\" x2=\"12\" y2=\"15\"/></svg>
                Change Photo
              </button>
            </form>
          </div>
        </div>
      </div>

      ";
        // line 236
        yield "      <div class=\"section\">
        <div class=\"section-title\">Personal Information</div>
        <form action=\"";
        // line 238
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile_update_info");
        yield "\" method=\"POST\">
          <div class=\"field-row\">
            <div class=\"field\">
              <label for=\"name\">Full Name</label>
              <div class=\"input-wrap\">
                <span class=\"input-icon\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2\"/><circle cx=\"12\" cy=\"7\" r=\"4\"/></svg></span>
                <input type=\"text\" id=\"name\" name=\"name\" value=\"";
        // line 244
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 244, $this->source); })()), "name", [], "any", false, false, false, 244), "html", null, true);
        yield "\" required minlength=\"3\" maxlength=\"100\"/>
              </div>
            </div>
            <div class=\"field\">
              <label for=\"phone\">Phone <span style=\"font-size:.6rem;color:var(--muted);font-weight:400;\">(optional)</span></label>
              <div class=\"input-wrap\">
                <span class=\"input-icon\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.63 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.8a16 16 0 0 0 6.29 6.29l.96-.96a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z\"/></svg></span>
                <input type=\"tel\" id=\"phone\" name=\"phone\" value=\"";
        // line 251
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "phone", [], "any", true, true, false, 251) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 251, $this->source); })()), "phone", [], "any", false, false, false, 251)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 251, $this->source); })()), "phone", [], "any", false, false, false, 251), "html", null, true)) : (""));
        yield "\" placeholder=\"12345678\" maxlength=\"8\"/>
              </div>
            </div>
          </div>
          <div class=\"field\">
            <label>Email Address <span style=\"font-size:.6rem;color:var(--muted);font-weight:400;\">(cannot be changed)</span></label>
            <div class=\"input-wrap\">
              <span class=\"input-icon\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z\"/><polyline points=\"22,6 12,13 2,6\"/></svg></span>
              <input type=\"email\" value=\"";
        // line 259
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 259, $this->source); })()), "email", [], "any", false, false, false, 259), "html", null, true);
        yield "\" disabled/>
            </div>
          </div>
          <button type=\"submit\" class=\"btn-save\">SAVE CHANGES</button>
        </form>
      </div>

      ";
        // line 267
        yield "      <div class=\"section\">
        <div class=\"section-title\">Change Password</div>
        <form action=\"";
        // line 269
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile_change_password");
        yield "\" method=\"POST\">
          <div class=\"field\">
            <label for=\"current_password\">Current Password</label>
            <div class=\"input-wrap\">
              <span class=\"input-icon\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><rect x=\"3\" y=\"11\" width=\"18\" height=\"11\" rx=\"2\"/><path d=\"M7 11V7a5 5 0 0 1 10 0v4\"/></svg></span>
              <input type=\"password\" id=\"current_password\" name=\"current_password\" placeholder=\"Your current password\"/>
              <button type=\"button\" class=\"eye\" onclick=\"togglePwd('current_password','eye-cur')\">
                <svg id=\"eye-cur\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/></svg>
              </button>
            </div>
          </div>
          <div class=\"field-row\">
            <div class=\"field\">
              <label for=\"new_password\">New Password</label>
              <div class=\"input-wrap\">
                <span class=\"input-icon\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z\"/></svg></span>
                <input type=\"password\" id=\"new_password\" name=\"new_password\" placeholder=\"Min. 6 chars\" oninput=\"checkStrength(this.value)\"/>
                <button type=\"button\" class=\"eye\" onclick=\"togglePwd('new_password','eye-new')\">
                  <svg id=\"eye-new\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/></svg>
                </button>
              </div>
              <div class=\"sbar\"><div class=\"sfill\" id=\"sfill\"></div></div>
              <div class=\"slbl\" id=\"slbl\">Enter new password</div>
            </div>
            <div class=\"field\">
              <label for=\"confirm_password\">Confirm New Password</label>
              <div class=\"input-wrap\">
                <span class=\"input-icon\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z\"/></svg></span>
                <input type=\"password\" id=\"confirm_password\" name=\"confirm_password\" placeholder=\"Repeat password\"/>
                <button type=\"button\" class=\"eye\" onclick=\"togglePwd('confirm_password','eye-conf')\">
                  <svg id=\"eye-conf\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/></svg>
                </button>
              </div>
            </div>
          </div>
          <button type=\"submit\" class=\"btn-save\">CHANGE PASSWORD</button>
        </form>
      </div>

    </div>
  </div>
</div>

<script>
  // Photo preview before upload
  function previewPhoto(input) {
    if (!input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
      const prev = document.getElementById('photoPreview');
      const init = document.getElementById('photoInit');
      if (prev) { prev.src = e.target.result; }
      else if (init) {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.className = 'photo-preview';
        img.id = 'photoPreview';
        init.replaceWith(img);
      }
      // Auto-submit the photo form
      document.getElementById('photoForm').submit();
    };
    reader.readAsDataURL(input.files[0]);
  }

  // Password toggle
  function togglePwd(id, iconId) {
    const inp  = document.getElementById(id);
    const icon = document.getElementById(iconId);
    inp.type = inp.type === 'password' ? 'text' : 'password';
    icon.innerHTML = inp.type === 'text'
      ? `<path d=\"M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24\"/><line x1=\"1\" y1=\"1\" x2=\"23\" y2=\"23\"/>`
      : `<path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/>`;
  }

  // Password strength
  function checkStrength(val) {
    const fill = document.getElementById('sfill');
    const lbl  = document.getElementById('slbl');
    let s = 0;
    if (val.length >= 6)   s++;
    if (/[A-Z]/.test(val)) s++;
    if (/[0-9]/.test(val)) s++;
    if (/[\\W_]/.test(val)) s++;
    const levels = [
      { w:'0%',   c:'transparent', t:'Enter new password' },
      { w:'25%',  c:'#e8392c',     t:'Weak' },
      { w:'50%',  c:'#f5a623',     t:'Fair' },
      { w:'75%',  c:'#f5c842',     t:'Good' },
      { w:'100%', c:'#2ecfb8',     t:'Strong ✓' },
    ];
    const lv = levels[val.length === 0 ? 0 : s];
    fill.style.width      = lv.w;
    fill.style.background = lv.c;
    lbl.textContent       = val.length === 0 ? 'Enter new password' : lv.t;
    lbl.style.color       = val.length === 0 ? 'var(--muted)' : lv.c;
  }
</script>
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
        return "profile/index.html.twig";
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
        return array (  413 => 269,  409 => 267,  399 => 259,  388 => 251,  378 => 244,  369 => 238,  365 => 236,  351 => 224,  347 => 222,  341 => 220,  333 => 218,  331 => 217,  326 => 214,  323 => 212,  317 => 211,  307 => 208,  303 => 206,  299 => 204,  297 => 203,  292 => 202,  287 => 201,  282 => 200,  272 => 191,  262 => 183,  252 => 176,  244 => 171,  236 => 167,  232 => 165,  230 => 164,  226 => 163,  222 => 162,  218 => 161,  215 => 160,  209 => 158,  201 => 156,  199 => 155,  190 => 149,  182 => 143,  45 => 7,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# templates/profile/index.html.twig
   User profile page — same visual style as login/register.
   Left panel: identity card with avatar, name, role, stats.
   Right panel: editable sections (info, photo, password).
   Route: /profile  (name: app_profile, requires ROLE_USER)
#}
<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta charset=\"UTF-8\"/>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
  <title>LAMMA — My Profile</title>
  <link href=\"https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap\" rel=\"stylesheet\"/>
  <style>
    :root {
      --red:     #e8392c;
      --teal:    #2ecfb8;
      --yellow:  #f5c842;
      --dark:    #080809;
      --surface: #0f0f11;
      --card:    #141416;
      --line:    rgba(255,255,255,0.07);
      --muted:   rgba(255,255,255,0.38);
      --soft:    rgba(255,255,255,0.65);
      --white:   #ffffff;
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    html,body{height:100%;background:var(--dark);color:var(--white);font-family:'DM Sans',sans-serif;overflow:hidden;}

    .page{display:grid;grid-template-columns:1fr 1fr;height:100vh;}

    /* ══ LEFT PANEL ══ */
    .visual{position:relative;overflow:hidden;background:var(--surface);display:flex;flex-direction:column;justify-content:space-between;padding:44px 52px;}
    .visual::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 90% 55% at 30% 100%,rgba(232,57,44,0.40) 0%,transparent 60%),radial-gradient(ellipse 60% 45% at 85% 5%,rgba(46,207,184,0.22) 0%,transparent 55%);pointer-events:none;}
    .visual::after{content:'';position:absolute;inset:0;background-image:url(\"data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E\");background-size:200px;opacity:.6;pointer-events:none;}

    .beams{position:absolute;inset:0;pointer-events:none;overflow:hidden;}
    .beam{position:absolute;bottom:-10px;width:1.5px;background:linear-gradient(to top,rgba(255,255,255,0.13),transparent);animation:pulse 5s ease-in-out infinite alternate;}
    .beam:nth-child(1){left:15%;height:70%;transform:rotate(-18deg);animation-delay:0s;}
    .beam:nth-child(2){left:28%;height:82%;transform:rotate(-7deg);animation-delay:.9s;background:linear-gradient(to top,rgba(46,207,184,0.18),transparent);}
    .beam:nth-child(3){left:45%;height:95%;transform:rotate(0deg);animation-delay:1.7s;}
    .beam:nth-child(4){left:63%;height:68%;transform:rotate(9deg);animation-delay:.4s;background:linear-gradient(to top,rgba(232,57,44,0.18),transparent);}
    .beam:nth-child(5){left:79%;height:78%;transform:rotate(17deg);animation-delay:1.2s;}
    @keyframes pulse{0%{opacity:.4}100%{opacity:1}}

    .blob{position:absolute;border-radius:50%;filter:blur(1px);}
    .blob-1{width:180px;height:180px;background:var(--yellow);bottom:80px;left:-60px;opacity:.78;animation:drift 8s ease-in-out infinite alternate;}
    .blob-2{width:130px;height:155px;border-radius:50% 50% 50% 10%;background:var(--teal);top:50px;right:-40px;opacity:.82;animation:drift 10s ease-in-out infinite alternate-reverse;}
    @keyframes drift{0%{transform:translateY(0) rotate(0deg)}100%{transform:translateY(16px) rotate(6deg)}}

    .brand{position:relative;z-index:2;display:flex;align-items:center;gap:10px;}
    .brand-logo{width:44px;height:44px;object-fit:contain;border-radius:6px;filter:drop-shadow(0 2px 6px rgba(0,0,0,0.5));}
    .brand-name{font-family:'Bebas Neue',sans-serif;font-size:1.9rem;letter-spacing:.12em;color:var(--white);line-height:1;}
    .brand-name span{color:var(--red);}

    /* Identity card */
    .identity{position:relative;z-index:2;display:flex;flex-direction:column;align-items:center;text-align:center;}
    .id-avatar-wrap{position:relative;margin-bottom:20px;}
    .id-avatar{width:110px;height:110px;border-radius:50%;object-fit:cover;border:3px solid rgba(255,255,255,.15);display:block;}
    .id-avatar-init{width:110px;height:110px;border-radius:50%;background:var(--red);border:3px solid rgba(232,57,44,.3);display:grid;place-items:center;font-family:'Bebas Neue',sans-serif;font-size:2.8rem;color:var(--white);}
    .id-name{font-family:'Bebas Neue',sans-serif;font-size:2rem;letter-spacing:.06em;margin-bottom:4px;}
    .id-email{font-size:.82rem;color:var(--muted);margin-bottom:12px;}
    .id-role{display:inline-flex;align-items:center;gap:5px;padding:4px 14px;border-radius:20px;font-size:.68rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;}
    .role-user{background:rgba(245,200,66,.12);color:var(--yellow);}
    .role-admin{background:rgba(232,57,44,.12);color:var(--red);}

    .id-stats{display:flex;gap:28px;margin-top:28px;}
    .id-stat{text-align:center;}
    .id-stat-num{font-family:'Bebas Neue',sans-serif;font-size:1.6rem;letter-spacing:.04em;}
    .id-stat-lbl{font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);}
    .id-stat-div{width:1px;background:var(--line);align-self:stretch;}

    .left-footer{position:relative;z-index:2;}
    .logout-link{display:inline-flex;align-items:center;gap:7px;font-size:.8rem;font-weight:600;color:var(--muted);text-decoration:none;padding:8px 14px;border:1px solid var(--line);border-radius:8px;transition:all .2s;}
    .logout-link:hover{color:var(--white);border-color:rgba(255,255,255,.2);background:rgba(255,255,255,.04);}
    .logout-link svg{width:15px;height:15px;}

    /* ══ RIGHT PANEL ══ */
    .form-panel{background:var(--card);overflow-y:auto;display:flex;align-items:flex-start;justify-content:center;padding:44px 52px;position:relative;}
    .form-panel::before{content:'';position:absolute;top:0;right:0;width:280px;height:280px;background:radial-gradient(circle,rgba(46,207,184,0.06) 0%,transparent 70%);pointer-events:none;}
    .form-panel::-webkit-scrollbar{width:4px;}
    .form-panel::-webkit-scrollbar-thumb{background:var(--line);}
    .form-inner{width:100%;max-width:440px;padding-bottom:24px;}

    .form-header{margin-bottom:32px;}
    .form-header h1{font-family:'Bebas Neue',sans-serif;font-size:2.4rem;letter-spacing:.08em;margin-bottom:6px;}
    .form-header p{font-size:.85rem;color:var(--muted);line-height:1.6;}

    /* flash messages */
    .flash{padding:11px 16px;border-radius:8px;font-size:.83rem;margin-bottom:12px;border:1px solid;display:flex;align-items:center;gap:9px;}
    .flash-success{background:rgba(46,207,184,.08);border-color:rgba(46,207,184,.25);color:var(--teal);}
    .flash-error{background:rgba(232,57,44,.08);border-color:rgba(232,57,44,.25);color:#ff8a80;}
    .flash svg{width:15px;height:15px;flex-shrink:0;}

    /* sections */
    .section{background:var(--surface);border:1px solid var(--line);border-radius:12px;padding:22px 22px 20px;margin-bottom:16px;}
    .section-title{font-size:.68rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--muted);margin-bottom:16px;display:flex;align-items:center;gap:8px;}
    .section-title::after{content:'';flex:1;height:1px;background:var(--line);}

    /* photo section */
    .photo-row{display:flex;align-items:center;gap:16px;}
    .photo-preview{width:64px;height:64px;border-radius:50%;object-fit:cover;border:2px solid var(--line);flex-shrink:0;}
    .photo-init{width:64px;height:64px;border-radius:50%;background:var(--red);border:2px solid rgba(232,57,44,.3);display:grid;place-items:center;font-family:'Bebas Neue',sans-serif;font-size:1.5rem;color:var(--white);flex-shrink:0;}
    .photo-info p{font-size:.78rem;color:var(--muted);margin-bottom:6px;}
    .photo-btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:7px;background:var(--card);border:1px solid var(--line);color:var(--soft);font-family:'DM Sans',sans-serif;font-size:.8rem;font-weight:600;cursor:pointer;transition:all .2s;}
    .photo-btn:hover{border-color:rgba(255,255,255,.2);color:var(--white);}
    .photo-btn svg{width:13px;height:13px;}

    /* fields */
    .field{display:flex;flex-direction:column;gap:6px;margin-bottom:14px;}
    .field:last-child{margin-bottom:0;}
    label{font-size:.68rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);}
    .input-wrap{position:relative;}
    .input-icon{position:absolute;left:13px;top:50%;transform:translateY(-50%);pointer-events:none;color:var(--muted);display:flex;}
    .input-icon svg{width:14px;height:14px;}
    input[type=\"text\"],input[type=\"email\"],input[type=\"password\"],input[type=\"tel\"]{width:100%;background:var(--card);border:1px solid var(--line);border-radius:8px;padding:12px 13px 12px 38px;font-family:'DM Sans',sans-serif;font-size:.88rem;color:var(--white);outline:none;transition:border-color .2s,box-shadow .2s,background .2s;}
    input::placeholder{color:rgba(255,255,255,.2);}
    input:focus{border-color:var(--teal);background:rgba(46,207,184,.05);box-shadow:0 0 0 3px rgba(46,207,184,.1);}
    input:disabled{opacity:.45;cursor:not-allowed;}
    .eye{position:absolute;right:11px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--muted);display:flex;transition:color .2s;}
    .eye:hover{color:var(--white);}
    .eye svg{width:15px;height:15px;}

    .field-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;}

    /* strength bar */
    .sbar{height:2px;background:var(--line);border-radius:2px;overflow:hidden;margin-top:6px;}
    .sfill{height:100%;width:0;border-radius:2px;transition:width .4s,background .4s;}
    .slbl{font-size:.65rem;color:var(--muted);margin-top:3px;}

    /* submit */
    .btn-save{width:100%;margin-top:16px;padding:13px;background:var(--red);border:none;border-radius:8px;font-family:'Bebas Neue',sans-serif;font-size:1.05rem;letter-spacing:.12em;color:var(--white);cursor:pointer;transition:background .2s,transform .15s,box-shadow .2s;}
    .btn-save:hover{background:#c93228;transform:translateY(-1px);box-shadow:0 8px 24px rgba(232,57,44,.3);}
    .btn-save:active{transform:translateY(0);}

    @media(max-width:900px){html,body{overflow:auto;}.page{grid-template-columns:1fr;height:auto;}.visual{min-height:320px;}.form-panel{padding:36px 24px;}.field-row{grid-template-columns:1fr;}}
  </style>
</head>
<body>
<div class=\"page\">

  {# ══ LEFT PANEL ══ #}
  <div class=\"visual\">
    <div class=\"beams\"><div class=\"beam\"></div><div class=\"beam\"></div><div class=\"beam\"></div><div class=\"beam\"></div><div class=\"beam\"></div></div>
    <div class=\"blob blob-1\"></div>
    <div class=\"blob blob-2\"></div>

    <div class=\"brand\">
      <img src=\"{{ asset('images/logo.png') }}\" alt=\"LAMMA\" class=\"brand-logo\"/>
      <div class=\"brand-name\">LAMMA<span>.</span></div>
    </div>

    <div class=\"identity\">
      <div class=\"id-avatar-wrap\">
        {% if user.image %}
          <img src=\"{{ asset('uploads/images/' ~ user.image) }}\" alt=\"{{ user.name }}\" class=\"id-avatar\"/>
        {% else %}
          <div class=\"id-avatar-init\">{{ user.name|slice(0,1)|upper }}</div>
        {% endif %}
      </div>
      <div class=\"id-name\">{{ user.name }}</div>
      <div class=\"id-email\">{{ user.email }}</div>
      <span class=\"id-role {{ user.role == 'ADMIN' ? 'role-admin' : 'role-user' }}\">
        {% if user.role == 'ADMIN' %}
          <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.5\" stroke-linecap=\"round\" width=\"10\" height=\"10\"><path d=\"M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z\"/></svg>
        {% endif %}
        {{ user.role }}
      </span>
      <div class=\"id-stats\">
        <div class=\"id-stat\">
          <div class=\"id-stat-num\">{{ user.phone ?? '—' }}</div>
          <div class=\"id-stat-lbl\">Phone</div>
        </div>
        <div class=\"id-stat-div\"></div>
        <div class=\"id-stat\">
          <div class=\"id-stat-num\">{{ user.motorized ?? '—' }}</div>
          <div class=\"id-stat-lbl\">Motorized</div>
        </div>
      </div>
    </div>

    <div class=\"left-footer\">
      <a href=\"{{ path('app_logout') }}\" class=\"logout-link\">
        <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4\"/><polyline points=\"16 17 21 12 16 7\"/><line x1=\"21\" y1=\"12\" x2=\"9\" y2=\"12\"/></svg>
        Sign Out
      </a>
    </div>
  </div>

  {# ══ RIGHT PANEL ══ #}
  <div class=\"form-panel\">
    <div class=\"form-inner\">

      <div class=\"form-header\">
        <h1>My Profile</h1>
        <p>Manage your personal information and account security.</p>
      </div>

      {# Flash messages #}
      {% for label, messages in app.flashes %}
        {% for message in messages %}
          <div class=\"flash flash-{{ label }}\">
            {% if label == 'success' %}
              <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.5\" stroke-linecap=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg>
            {% else %}
              <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.5\" stroke-linecap=\"round\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><line x1=\"15\" y1=\"9\" x2=\"9\" y2=\"15\"/><line x1=\"9\" y1=\"9\" x2=\"15\" y2=\"15\"/></svg>
            {% endif %}
            {{ message }}
          </div>
        {% endfor %}
      {% endfor %}

      {# ── Section 1: Profile Photo ── #}
      <div class=\"section\">
        <div class=\"section-title\">Profile Photo</div>
        <div class=\"photo-row\">
          {% if user.image %}
            <img src=\"{{ asset('uploads/images/' ~ user.image) }}\" alt=\"{{ user.name }}\" class=\"photo-preview\" id=\"photoPreview\"/>
          {% else %}
            <div class=\"photo-init\" id=\"photoInit\">{{ user.name|slice(0,1)|upper }}</div>
          {% endif %}
          <div class=\"photo-info\">
            <p>PNG, JPG or WEBP · Max 2 MB</p>
            <form action=\"{{ path('app_profile_update_photo') }}\" method=\"POST\" enctype=\"multipart/form-data\" id=\"photoForm\">
              <input type=\"file\" name=\"image\" id=\"photoInput\" accept=\"image/*\" style=\"display:none\" onchange=\"previewPhoto(this)\"/>
              <button type=\"button\" class=\"photo-btn\" onclick=\"document.getElementById('photoInput').click()\">
                <svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4\"/><polyline points=\"17 8 12 3 7 8\"/><line x1=\"12\" y1=\"3\" x2=\"12\" y2=\"15\"/></svg>
                Change Photo
              </button>
            </form>
          </div>
        </div>
      </div>

      {# ── Section 2: Personal Info ── #}
      <div class=\"section\">
        <div class=\"section-title\">Personal Information</div>
        <form action=\"{{ path('app_profile_update_info') }}\" method=\"POST\">
          <div class=\"field-row\">
            <div class=\"field\">
              <label for=\"name\">Full Name</label>
              <div class=\"input-wrap\">
                <span class=\"input-icon\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2\"/><circle cx=\"12\" cy=\"7\" r=\"4\"/></svg></span>
                <input type=\"text\" id=\"name\" name=\"name\" value=\"{{ user.name }}\" required minlength=\"3\" maxlength=\"100\"/>
              </div>
            </div>
            <div class=\"field\">
              <label for=\"phone\">Phone <span style=\"font-size:.6rem;color:var(--muted);font-weight:400;\">(optional)</span></label>
              <div class=\"input-wrap\">
                <span class=\"input-icon\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.63 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.8a16 16 0 0 0 6.29 6.29l.96-.96a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z\"/></svg></span>
                <input type=\"tel\" id=\"phone\" name=\"phone\" value=\"{{ user.phone ?? '' }}\" placeholder=\"12345678\" maxlength=\"8\"/>
              </div>
            </div>
          </div>
          <div class=\"field\">
            <label>Email Address <span style=\"font-size:.6rem;color:var(--muted);font-weight:400;\">(cannot be changed)</span></label>
            <div class=\"input-wrap\">
              <span class=\"input-icon\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z\"/><polyline points=\"22,6 12,13 2,6\"/></svg></span>
              <input type=\"email\" value=\"{{ user.email }}\" disabled/>
            </div>
          </div>
          <button type=\"submit\" class=\"btn-save\">SAVE CHANGES</button>
        </form>
      </div>

      {# ── Section 3: Change Password ── #}
      <div class=\"section\">
        <div class=\"section-title\">Change Password</div>
        <form action=\"{{ path('app_profile_change_password') }}\" method=\"POST\">
          <div class=\"field\">
            <label for=\"current_password\">Current Password</label>
            <div class=\"input-wrap\">
              <span class=\"input-icon\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><rect x=\"3\" y=\"11\" width=\"18\" height=\"11\" rx=\"2\"/><path d=\"M7 11V7a5 5 0 0 1 10 0v4\"/></svg></span>
              <input type=\"password\" id=\"current_password\" name=\"current_password\" placeholder=\"Your current password\"/>
              <button type=\"button\" class=\"eye\" onclick=\"togglePwd('current_password','eye-cur')\">
                <svg id=\"eye-cur\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/></svg>
              </button>
            </div>
          </div>
          <div class=\"field-row\">
            <div class=\"field\">
              <label for=\"new_password\">New Password</label>
              <div class=\"input-wrap\">
                <span class=\"input-icon\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z\"/></svg></span>
                <input type=\"password\" id=\"new_password\" name=\"new_password\" placeholder=\"Min. 6 chars\" oninput=\"checkStrength(this.value)\"/>
                <button type=\"button\" class=\"eye\" onclick=\"togglePwd('new_password','eye-new')\">
                  <svg id=\"eye-new\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/></svg>
                </button>
              </div>
              <div class=\"sbar\"><div class=\"sfill\" id=\"sfill\"></div></div>
              <div class=\"slbl\" id=\"slbl\">Enter new password</div>
            </div>
            <div class=\"field\">
              <label for=\"confirm_password\">Confirm New Password</label>
              <div class=\"input-wrap\">
                <span class=\"input-icon\"><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z\"/></svg></span>
                <input type=\"password\" id=\"confirm_password\" name=\"confirm_password\" placeholder=\"Repeat password\"/>
                <button type=\"button\" class=\"eye\" onclick=\"togglePwd('confirm_password','eye-conf')\">
                  <svg id=\"eye-conf\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\"><path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/></svg>
                </button>
              </div>
            </div>
          </div>
          <button type=\"submit\" class=\"btn-save\">CHANGE PASSWORD</button>
        </form>
      </div>

    </div>
  </div>
</div>

<script>
  // Photo preview before upload
  function previewPhoto(input) {
    if (!input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
      const prev = document.getElementById('photoPreview');
      const init = document.getElementById('photoInit');
      if (prev) { prev.src = e.target.result; }
      else if (init) {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.className = 'photo-preview';
        img.id = 'photoPreview';
        init.replaceWith(img);
      }
      // Auto-submit the photo form
      document.getElementById('photoForm').submit();
    };
    reader.readAsDataURL(input.files[0]);
  }

  // Password toggle
  function togglePwd(id, iconId) {
    const inp  = document.getElementById(id);
    const icon = document.getElementById(iconId);
    inp.type = inp.type === 'password' ? 'text' : 'password';
    icon.innerHTML = inp.type === 'text'
      ? `<path d=\"M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24\"/><line x1=\"1\" y1=\"1\" x2=\"23\" y2=\"23\"/>`
      : `<path d=\"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/>`;
  }

  // Password strength
  function checkStrength(val) {
    const fill = document.getElementById('sfill');
    const lbl  = document.getElementById('slbl');
    let s = 0;
    if (val.length >= 6)   s++;
    if (/[A-Z]/.test(val)) s++;
    if (/[0-9]/.test(val)) s++;
    if (/[\\W_]/.test(val)) s++;
    const levels = [
      { w:'0%',   c:'transparent', t:'Enter new password' },
      { w:'25%',  c:'#e8392c',     t:'Weak' },
      { w:'50%',  c:'#f5a623',     t:'Fair' },
      { w:'75%',  c:'#f5c842',     t:'Good' },
      { w:'100%', c:'#2ecfb8',     t:'Strong ✓' },
    ];
    const lv = levels[val.length === 0 ? 0 : s];
    fill.style.width      = lv.w;
    fill.style.background = lv.c;
    lbl.textContent       = val.length === 0 ? 'Enter new password' : lv.t;
    lbl.style.color       = val.length === 0 ? 'var(--muted)' : lv.c;
  }
</script>
</body>
</html>
", "profile/index.html.twig", "C:\\Users\\saifl\\OneDrive\\Desktop\\back_saif2\\user_symfony_saif\\user_saif\\templates\\profile\\index.html.twig");
    }
}
