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

/* components/itilobject/fields/priority_matrix.html.twig */
class __TwigTemplate_6064888a136c5bd0c17946bb0cf3ef0305fb5e12fb9dacb2060560994cd325bc extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/itilobject/fields/priority_matrix.html.twig", 34)->unwrap();
        // line 35
        $context["rand"] = Twig\Extension\CoreExtension::random($this->env->getCharset());
        // line 36
        yield "
";
        // line 37
        $context["urgency_options"] = Twig\Extension\CoreExtension::merge(($context["field_options"] ?? null), ["disabled" =>  !(        // line 38
($context["canupdate"] ?? null) || ($context["can_requester"] ?? null))]);
        // line 40
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["field_options"] ?? null), "fields_template", [], "any", false, false, false, 40), "isMandatoryField", ["urgency"], "method", false, false, false, 40)) {
            // line 41
            yield "   ";
            $context["urgency_options"] = Twig\Extension\CoreExtension::merge(($context["urgency_options"] ?? null), ["required" => true]);
        }
        // line 45
        yield "
";
        // line 46
        yield CoreExtension::callMacro($macros["fields"], "macro_field", ["urgency", CoreExtension::getAttribute($this->env, $this->source,         // line 48
($context["item"] ?? null), "dropdownUrgency", [Twig\Extension\CoreExtension::merge(["value" => (($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source,         // line 49
($context["item"] ?? null), "fields", [], "any", false, false, false, 49)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["urgency"] ?? null) : null), "width" => "100%", "display" => false, "rand" =>         // line 52
($context["rand"] ?? null)],         // line 53
($context["urgency_options"] ?? null))], "method", false, false, false, 48), __("Urgency"),         // line 55
($context["field_options"] ?? null)], 46, $context, $this->getSourceContext());
        // line 56
        yield "

";
        // line 58
        $context["impact_options"] = ($context["field_options"] ?? null);
        // line 59
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["field_options"] ?? null), "fields_template", [], "any", false, false, false, 59), "isMandatoryField", ["impact"], "method", false, false, false, 59)) {
            // line 60
            yield "   ";
            $context["impact_options"] = Twig\Extension\CoreExtension::merge(($context["impact_options"] ?? null), ["required" => true]);
        }
        // line 64
        yield "
";
        // line 65
        yield CoreExtension::callMacro($macros["fields"], "macro_field", ["impact", CoreExtension::getAttribute($this->env, $this->source,         // line 67
($context["item"] ?? null), "dropdownImpact", [Twig\Extension\CoreExtension::merge(["value" => (($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source,         // line 68
($context["item"] ?? null), "fields", [], "any", false, false, false, 68)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["impact"] ?? null) : null), "width" => "100%", "display" => false, "rand" =>         // line 71
($context["rand"] ?? null)],         // line 72
($context["impact_options"] ?? null))], "method", false, false, false, 67), __("Impact"),         // line 74
($context["field_options"] ?? null)], 65, $context, $this->getSourceContext());
        // line 75
        yield "

";
        // line 77
        $context["priority_options"] = Twig\Extension\CoreExtension::merge(($context["field_options"] ?? null), ["disabled" =>  !        // line 78
($context["canpriority"] ?? null), "withmajor" => true]);
        // line 81
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["field_options"] ?? null), "fields_template", [], "any", false, false, false, 81), "isMandatoryField", ["priority"], "method", false, false, false, 81)) {
            // line 82
            yield "   ";
            $context["priority_options"] = Twig\Extension\CoreExtension::merge(($context["priority_options"] ?? null), ["required" => true]);
        }
        // line 86
        yield "
";
        // line 87
        yield CoreExtension::callMacro($macros["fields"], "macro_field", ["priority", CoreExtension::getAttribute($this->env, $this->source,         // line 89
($context["item"] ?? null), "dropdownPriority", [Twig\Extension\CoreExtension::merge(["value" => (($__internal_compile_2 = CoreExtension::getAttribute($this->env, $this->source,         // line 90
($context["item"] ?? null), "fields", [], "any", false, false, false, 90)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["priority"] ?? null) : null), "width" => "100%", "display" => false, "rand" =>         // line 93
($context["rand"] ?? null)], Twig\Extension\CoreExtension::merge(        // line 94
($context["field_options"] ?? null), ($context["priority_options"] ?? null)))], "method", false, false, false, 89), __("Priority"),         // line 96
($context["field_options"] ?? null)], 87, $context, $this->getSourceContext());
        // line 97
        yield "

<script type=\"text/javascript\">
\$(function() {
   \$('#dropdown_urgency";
        // line 101
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
        yield ", #dropdown_impact";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
        yield "').on('change.select2', function (e) {
      \$.ajax({
         url: \"";
        // line 103
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("/ajax/priority.php"), "html", null, true);
        yield "\",
         datatype: 'json',
         data: {
            'urgency': \$('#dropdown_urgency";
        // line 106
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
        yield "').select2('data') ? \$('#dropdown_urgency";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
        yield "').select2('data')[0].id : 0,
            'impact':  \$('#dropdown_impact";
        // line 107
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
        yield "').select2('data') ? \$('#dropdown_impact";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
        yield "').select2('data')[0].id : 0,
            '_predefined_fields':  \$('input[name=\"_predefined_fields\"]').val(),
            'getJson': true,
         }
      }).done(function(data) {
         \$('#dropdown_priority";
        // line 112
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
        yield "').val(data.priority);
         \$('#dropdown_priority";
        // line 113
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
        yield "').trigger('change');
      });
   })
});
</script>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/itilobject/fields/priority_matrix.html.twig";
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
        return array (  151 => 113,  147 => 112,  137 => 107,  131 => 106,  125 => 103,  118 => 101,  112 => 97,  110 => 96,  109 => 94,  108 => 93,  107 => 90,  106 => 89,  105 => 87,  102 => 86,  98 => 82,  96 => 81,  94 => 78,  93 => 77,  89 => 75,  87 => 74,  86 => 72,  85 => 71,  84 => 68,  83 => 67,  82 => 65,  79 => 64,  75 => 60,  73 => 59,  71 => 58,  67 => 56,  65 => 55,  64 => 53,  63 => 52,  62 => 49,  61 => 48,  60 => 46,  57 => 45,  53 => 41,  51 => 40,  49 => 38,  48 => 37,  45 => 36,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/fields/priority_matrix.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\fields\\priority_matrix.html.twig");
    }
}
