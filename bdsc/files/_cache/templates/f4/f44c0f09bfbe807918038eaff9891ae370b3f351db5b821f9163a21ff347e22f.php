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

/* components/itilobject/fields/status.html.twig */
class __TwigTemplate_a04588d2fddf82c78bad5818a23d3cc1730ce8ee1997e39decc9e4fe68cece7f extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/itilobject/fields/status.html.twig", 34)->unwrap();
        // line 35
        yield "
";
        // line 36
        if (($context["canupdate"] ?? null)) {
            // line 37
            yield "   ";
            $context["status_field"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 38
                yield "      ";
                yield CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "dropdownStatus", [Twig\Extension\CoreExtension::merge(["value" => ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,                 // line 39
($context["item"] ?? null), "input", [], "any", false, true, false, 39), "status", [], "array", true, true, false, 39)) ? (Twig\Extension\CoreExtension::default((($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "input", [], "any", false, true, false, 39)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["status"] ?? null) : null), (($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 39)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["status"] ?? null) : null))) : ((($__internal_compile_2 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 39)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["status"] ?? null) : null))), "value_calculation" => (($__internal_compile_3 = CoreExtension::getAttribute($this->env, $this->source,                 // line 40
($context["item"] ?? null), "fields", [], "any", false, false, false, 40)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["status"] ?? null) : null), "showtype" => "allowed", "width" => "100%", "display" => false],                 // line 44
($context["field_options"] ?? null))], "method", false, false, false, 38);
                yield "

      ";
                // line 46
                $context["validation_class"] = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getValidationClassInstance", [], "method", false, false, false, 46);
                // line 47
                yield "      ";
                if ( !(null === ($context["validation_class"] ?? null))) {
                    // line 48
                    yield "         ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["validation_class"] ?? null), "alertValidation", [($context["item"] ?? null), "status"], "method", false, false, false, 48), "html", null, true);
                    yield "
      ";
                }
                // line 50
                yield "
      ";
                // line 51
                yield Twig\Extension\CoreExtension::include($this->env, $context, "components/itilobject/timeline/pending_reasons_messages.html.twig", ["display_for_parent" => true]);
                // line 53
                yield "
   ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
        } else {
            // line 56
            yield "   ";
            $context["field_options"] = Twig\Extension\CoreExtension::merge(($context["field_options"] ?? null), ["center" => true]);
            // line 57
            yield "   ";
            $context["status_field"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 58
                yield "      ";
                yield CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getStatusIcon", [(($__internal_compile_4 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 58)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["status"] ?? null) : null)], "method", false, false, false, 58);
                yield "
      ";
                // line 59
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getStatus", [(($__internal_compile_5 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 59)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["status"] ?? null) : null)], "method", false, false, false, 59), "html", null, true);
                yield "

      ";
                // line 61
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "canReopen", [], "method", false, false, false, 61)) {
                    // line 62
                    yield "         <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getLinkURL", [], "method", false, false, false, 62), "html", null, true);
                    yield "&amp;_openfollowup=1\"
            class=\"btn btn-ghost-secondary\">
            <i class=\"far fa-folder-open\"></i>
            <span>";
                    // line 65
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Reopen"), "html", null, true);
                    yield "</span>
         </a>
      ";
                }
                // line 68
                yield "   ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
        }
        // line 70
        yield "
";
        // line 71
        yield CoreExtension::callMacro($macros["fields"], "macro_field", ["status",         // line 73
($context["status_field"] ?? null), __("Status"),         // line 75
($context["field_options"] ?? null)], 71, $context, $this->getSourceContext());
        // line 76
        yield "
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/itilobject/fields/status.html.twig";
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
        return array (  125 => 76,  123 => 75,  122 => 73,  121 => 71,  118 => 70,  113 => 68,  107 => 65,  100 => 62,  98 => 61,  93 => 59,  88 => 58,  85 => 57,  82 => 56,  76 => 53,  74 => 51,  71 => 50,  65 => 48,  62 => 47,  60 => 46,  55 => 44,  54 => 40,  53 => 39,  51 => 38,  48 => 37,  46 => 36,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/fields/status.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\fields\\status.html.twig");
    }
}
