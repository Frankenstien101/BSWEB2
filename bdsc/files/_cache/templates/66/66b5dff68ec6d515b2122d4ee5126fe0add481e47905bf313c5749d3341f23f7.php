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

/* components/itilobject/timeline/timeline_item_header_badges.html.twig */
class __TwigTemplate_0d9ad06e9b3ef7f2b8eb23fefd04e3ef61fcc402abf6c89956637291fbfb2049 extends Template
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
        $context["timeline_display_date"] = $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpitimeline_date_format");
        // line 35
        $context["date_creation_formatted"] = ($context["date_creation"] ?? null);
        // line 36
        $context["date_mod_formatted"] = ($context["date_mod"] ?? null);
        // line 37
        $context["date_creation_relative"] = ($context["date_creation"] ?? null);
        // line 38
        $context["date_mod_relative"] = ($context["date_mod"] ?? null);
        // line 39
        yield "
";
        // line 40
        if ( !(is_string($__internal_compile_0 = ($context["anchor"] ?? null)) && is_string($__internal_compile_1 = "Log_") && str_starts_with($__internal_compile_0, $__internal_compile_1))) {
            // line 41
            yield "    ";
            // line 42
            yield "    ";
            // line 43
            yield "    ";
            $context["date_creation_formatted"] = $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getFormattedDatetime(($context["date_creation"] ?? null));
            // line 44
            yield "    ";
            $context["date_mod_formatted"] = $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getFormattedDatetime(($context["date_mod"] ?? null));
            // line 45
            yield "    ";
            $context["date_creation_relative"] = $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getRelativeDatetime(($context["date_creation"] ?? null));
            // line 46
            yield "    ";
            $context["date_mod_relative"] = $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getRelativeDatetime(($context["date_mod"] ?? null));
        }
        // line 48
        yield "
<span class=\"badge user-select-auto text-wrap d-none d-md-block\">
   ";
        // line 50
        $context["date_span"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 51
            yield "      <span
         ";
            // line 52
            if ((0 === CoreExtension::compare(($context["timeline_display_date"] ?? null), Twig\Extension\CoreExtension::constant("Config::TIMELINE_RELATIVE_DATE")))) {
                // line 53
                yield "            title=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["date_creation_formatted"] ?? null), "html", null, true);
                yield "\"
            data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\"
         ";
            }
            // line 56
            yield "      >
         <i class=\"far fa-clock me-1\"></i>
         <a href=\"#";
            // line 58
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["anchor"] ?? null), "html", null, true);
            yield "\">
            ";
            // line 59
            if ((0 === CoreExtension::compare(($context["timeline_display_date"] ?? null), Twig\Extension\CoreExtension::constant("Config::TIMELINE_RELATIVE_DATE")))) {
                // line 60
                yield "               ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["date_creation_relative"] ?? null), "html", null, true);
                yield "
            ";
            } else {
                // line 62
                yield "               ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["date_creation_formatted"] ?? null), "html", null, true);
                yield "
            ";
            }
            // line 64
            yield "         </a>
      </span>
   ";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 67
        yield "
   ";
        // line 68
        if ((1 === CoreExtension::compare(($context["users_id"] ?? null), 0))) {
            // line 69
            yield "      ";
            $context["creator_span"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 70
                yield "         ";
                yield Twig\Extension\CoreExtension::include($this->env, $context, "components/user/link_with_tooltip.html.twig", ["users_id" =>                 // line 71
($context["users_id"] ?? null), "user_object" =>                 // line 72
($context["user_object"] ?? null), "enable_anonymization" =>                 // line 73
($context["anonym_user"] ?? null)], false);
                // line 74
                yield "
      ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 76
            yield "
      ";
            // line 77
            yield Twig\Extension\CoreExtension::sprintf(__("Created: %1\$s by %2\$s"), ($context["date_span"] ?? null), ($context["creator_span"] ?? null));
            yield "
   ";
        } else {
            // line 79
            yield "      ";
            yield Twig\Extension\CoreExtension::sprintf(__("Created: %1\$s"), ($context["date_span"] ?? null));
            yield "
   ";
        }
        // line 81
        yield "</span>

";
        // line 83
        if (((1 === CoreExtension::compare(($context["users_id_editor"] ?? null), 0)) && (0 !== CoreExtension::compare(($context["date_creation"] ?? null), ($context["date_mod"] ?? null))))) {
            // line 84
            yield "   <span class=\"badge user-select-auto text-wrap ms-1 d-none d-md-block\">
      ";
            // line 85
            $context["date_span"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 86
                yield "         <span
            ";
                // line 87
                if ((0 === CoreExtension::compare(($context["timeline_display_date"] ?? null), Twig\Extension\CoreExtension::constant("Config::TIMELINE_RELATIVE_DATE")))) {
                    // line 88
                    yield "               title=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["date_mod_formatted"] ?? null), "html", null, true);
                    yield "\"
               data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\"
            ";
                }
                // line 91
                yield "         >
            <i class=\"far fa-clock me-1\"></i>
            ";
                // line 93
                if ((0 === CoreExtension::compare(($context["timeline_display_date"] ?? null), Twig\Extension\CoreExtension::constant("Config::TIMELINE_RELATIVE_DATE")))) {
                    // line 94
                    yield "               ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["date_mod_relative"] ?? null), "html", null, true);
                    yield "
            ";
                } else {
                    // line 96
                    yield "               ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["date_mod_formatted"] ?? null), "html", null, true);
                    yield "
            ";
                }
                // line 98
                yield "         </span>
      ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 100
            yield "
      ";
            // line 101
            $context["is_current_editor"] = (0 === CoreExtension::compare(($context["users_id_editor"] ?? null), $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiID")));
            // line 102
            yield "      ";
            $context["anonym_editor"] = (((0 === CoreExtension::compare($this->extensions['Glpi\Application\View\Extension\SessionExtension']->getCurrentInterface(), "helpdesk")) &&  !($context["is_current_editor"] ?? null)) && (0 !== CoreExtension::compare($this->extensions['Glpi\Application\View\Extension\ConfigExtension']->getEntityConfig("anonymize_support_agents", $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiactive_entity")), Twig\Extension\CoreExtension::constant("Entity::ANONYMIZE_DISABLED"))));
            // line 103
            yield "      ";
            $context["editor_span"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 104
                yield "         ";
                yield Twig\Extension\CoreExtension::include($this->env, $context, "components/user/link_with_tooltip.html.twig", ["users_id" =>                 // line 105
($context["users_id_editor"] ?? null), "user_object" => (((0 === CoreExtension::compare(                // line 106
($context["users_id"] ?? null), ($context["users_id_editor"] ?? null)))) ? (($context["user_object"] ?? null)) : (null)), "enable_anonymization" =>                 // line 107
($context["anonym_editor"] ?? null)], false);
                // line 108
                yield "
      ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 110
            yield "
      ";
            // line 111
            yield Twig\Extension\CoreExtension::sprintf(__("Last update: %1\$s by %2\$s"), ($context["date_span"] ?? null), ($context["editor_span"] ?? null));
            yield "
   </span>
";
        }
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/itilobject/timeline/timeline_item_header_badges.html.twig";
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
        return array (  223 => 111,  220 => 110,  215 => 108,  213 => 107,  212 => 106,  211 => 105,  209 => 104,  206 => 103,  203 => 102,  201 => 101,  198 => 100,  193 => 98,  187 => 96,  181 => 94,  179 => 93,  175 => 91,  168 => 88,  166 => 87,  163 => 86,  161 => 85,  158 => 84,  156 => 83,  152 => 81,  146 => 79,  141 => 77,  138 => 76,  133 => 74,  131 => 73,  130 => 72,  129 => 71,  127 => 70,  124 => 69,  122 => 68,  119 => 67,  113 => 64,  107 => 62,  101 => 60,  99 => 59,  95 => 58,  91 => 56,  84 => 53,  82 => 52,  79 => 51,  77 => 50,  73 => 48,  69 => 46,  66 => 45,  63 => 44,  60 => 43,  58 => 42,  56 => 41,  54 => 40,  51 => 39,  49 => 38,  47 => 37,  45 => 36,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/timeline/timeline_item_header_badges.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\timeline\\timeline_item_header_badges.html.twig");
    }
}
