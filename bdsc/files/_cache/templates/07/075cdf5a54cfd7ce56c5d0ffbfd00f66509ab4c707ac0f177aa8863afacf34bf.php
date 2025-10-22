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

/* pages/setup/setup_notifications.html.twig */
class __TwigTemplate_6ceac92fdf315bacc4559d743c1e1ff27d97c0f194f3b3d5c8e676f606c1cc57 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 33
        yield "
";
        // line 34
        if ((($context["can_update_config"] ?? null) || ($context["has_active_mode"] ?? null))) {
            // line 35
            yield "   <div class=\"container\">
      <div class=\"row justify-content-evenly\">
      ";
            // line 37
            if (($context["can_update_config"] ?? null)) {
                // line 38
                yield "         <div class=\"card col-12 col-lg-5\">
            <form method=\"POST\" action=\"";
                // line 39
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("/front/setup.notification.php"), "html", null, true);
                yield "\" data-submit-once>
               <div class=\"card-header\">
                  <h3>";
                // line 41
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Notifications configuration"), "html", null, true);
                yield "</h3>
               </div>

               ";
                // line 44
                if ((($context["use_notifications"] ?? null) &&  !($context["has_active_mode"] ?? null))) {
                    // line 45
                    yield "                  <div class=\"alert alert-important alert-warning m-3\">
                     <i class=\"fa fa-exclamation-triangle me-2\"></i>
                     ";
                    // line 47
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("You must enable at least one notification mode."), "html", null, true);
                    yield "
                  </div>
               ";
                }
                // line 50
                yield "
               <ul class=\"list-group list-group-flush\">
                  <li class=\"list-group-item\">
                     <div class=\"form-check form-switch\">
                        <input name=\"use_notifications\" type=\"hidden\" value=\"0\" />
                        <input name=\"use_notifications\" id=\"use_notifications\"
                              class=\"form-check-input\" type=\"checkbox\" value=\"1\"
                              ";
                // line 57
                yield ((($context["use_notifications"] ?? null)) ? ("checked=\"checked\"") : (""));
                yield " />
                        <label class=\"form-check-label\" for=\"use_notifications\">
                           ";
                // line 59
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Enable followup"), "html", null, true);
                yield "
                        </label>
                     </div>
                  </li>
                  ";
                // line 63
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["modes"] ?? null));
                foreach ($context['_seq'] as $context["mode_key"] => $context["mode"]) {
                    // line 64
                    yield "                     ";
                    $context["mode_disabled"] =  !($context["use_notifications"] ?? null);
                    // line 65
                    yield "                     <li class=\"list-group-item ";
                    yield ((($context["mode_disabled"] ?? null)) ? ("disabled") : (""));
                    yield "\">
                        <div class=\"form-check form-switch\">
                           <input name=\"notifications_";
                    // line 67
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["mode_key"], "html", null, true);
                    yield "\" type=\"hidden\" value=\"0\" />
                           <input name=\"notifications_";
                    // line 68
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["mode_key"], "html", null, true);
                    yield "\" id=\"notifications_";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["mode_key"], "html", null, true);
                    yield "\"
                                 class=\"form-check-input\" type=\"checkbox\" value=\"1\"
                                 ";
                    // line 70
                    yield (((($__internal_compile_0 = $context["mode"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["is_active"] ?? null) : null)) ? ("checked=\"checked\"") : (""));
                    yield "
                                 ";
                    // line 71
                    yield ((($context["mode_disabled"] ?? null)) ? ("disabled") : (""));
                    yield " />
                           <label class=\"form-check-label\" for=\"notifications_";
                    // line 72
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["mode_key"], "html", null, true);
                    yield "\">
                              ";
                    // line 73
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_1 = $context["mode"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["label"] ?? null) : null), "html", null, true);
                    yield "
                           </label>
                        </div>
                     </li>
                  ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['mode_key'], $context['mode'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 78
                yield "               </ul>

               <div class=\"card-footer\">
                  <button type=\"submit\" class=\"btn btn-primary\">
                     <i class=\"far fa-save\"></i>
                     <span>";
                // line 83
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Save"), "html", null, true);
                yield "</span>
                  </button>
               </div>

               <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
                // line 87
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Session::getNewCSRFToken(), "html", null, true);
                yield "\" />
            </form>
         </div>
      ";
            }
            // line 91
            yield "
      ";
            // line 92
            if ((($context["use_notifications"] ?? null) && ($context["has_active_mode"] ?? null))) {
                // line 93
                yield "         <div class=\"card col-12 col-lg-5 mt-4 mt-lg-0\">
            <div class=\"card-header\">
               <h3>";
                // line 95
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Notification", "Notifications", Session::getPluralNumber()), "html", null, true);
                yield "</h3>
            </div>

            <div class=\"list-group list-group-flush\">
               ";
                // line 99
                if (Session::haveRight("config", Twig\Extension\CoreExtension::constant("READ"))) {
                    // line 100
                    yield "                  <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("front/notificationtemplate.php"), "html", null, true);
                    yield "\" class=\"list-group-item list-group-item-action\">
                     <i class=\"fa-fw ti ti-template\"></i>
                     <span>";
                    // line 102
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Notification template", "Notification templates", Session::getPluralNumber()), "html", null, true);
                    yield "</span>
                  </a>
               ";
                }
                // line 105
                yield "
               ";
                // line 106
                if (Session::haveRight("notification", Twig\Extension\CoreExtension::constant("READ"))) {
                    // line 107
                    yield "                  <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("front/notification.php"), "html", null, true);
                    yield "\" class=\"list-group-item list-group-item-action\">
                     <i class=\"fa-fw ti ti-bell \"></i>
                     <span>";
                    // line 109
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Notification", "Notifications", Session::getPluralNumber()), "html", null, true);
                    yield "</span>
                  </a>
               ";
                } else {
                    // line 112
                    yield "                  <div class=\"list-group-item\">
                     <div class=\"alert alert-important alert-warning m-3\">
                        <i class=\"fa-fw ti ti-alert-triangle me-2\"></i>
                        ";
                    // line 115
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Unable to configure notifications: please configure at least one followup type using the above configuration."), "html", null, true);
                    yield "
                     </div>
                  </div>
               ";
                }
                // line 119
                yield "
               ";
                // line 120
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["modes"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["mode"]) {
                    // line 121
                    yield "                  ";
                    if ((($context["can_update_config"] ?? null) && (($__internal_compile_2 = $context["mode"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["is_active"] ?? null) : null))) {
                        // line 122
                        yield "                     <a href=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_3 = $context["mode"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["setting_url"] ?? null) : null), "html", null, true);
                        yield "\" class=\"list-group-item list-group-item-action\">
                        <i class=\"fa-fw ";
                        // line 123
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_4 = $context["mode"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["icon"] ?? null) : null), "html", null, true);
                        yield "\"></i>
                        <span>";
                        // line 124
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_5 = $context["mode"]) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["label_settings"] ?? null) : null), "html", null, true);
                        yield "</span>
                     </a>
                  ";
                    }
                    // line 127
                    yield "               ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mode'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 128
                yield "            </div>

         </div
      ";
            }
            // line 132
            yield "      </div>
   </div>
";
        }
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "pages/setup/setup_notifications.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  260 => 132,  254 => 128,  248 => 127,  242 => 124,  238 => 123,  233 => 122,  230 => 121,  226 => 120,  223 => 119,  216 => 115,  211 => 112,  205 => 109,  199 => 107,  197 => 106,  194 => 105,  188 => 102,  182 => 100,  180 => 99,  173 => 95,  169 => 93,  167 => 92,  164 => 91,  157 => 87,  150 => 83,  143 => 78,  132 => 73,  128 => 72,  124 => 71,  120 => 70,  113 => 68,  109 => 67,  103 => 65,  100 => 64,  96 => 63,  89 => 59,  84 => 57,  75 => 50,  69 => 47,  65 => 45,  63 => 44,  57 => 41,  52 => 39,  49 => 38,  47 => 37,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "pages/setup/setup_notifications.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\pages\\setup\\setup_notifications.html.twig");
    }
}
