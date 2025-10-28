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

/* @formcreator/components/form/section_design.html.twig */
class __TwigTemplate_e79caf27a40189e3ccee590041b361068c590a450aff6fe7452bd8c3b26e3d38 extends Template
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
        // line 30
        yield "
";
        // line 31
        $context["lastSectionOrder"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorCommon::getMax", [($context["item"] ?? null), ["plugin_formcreator_forms_id" => (($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 31)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["plugin_formcreator_forms_id"] ?? null) : null)], "order"]);
        // line 32
        yield "
<li class=\"plugin_formcreator_section\" data-itemtype=\"PluginFormcreatorSection\" data-id=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 33)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["id"] ?? null) : null), "html", null, true);
        yield "\">
    ";
        // line 34
        $context["conditionsCount"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorCondition::countForItem", [($context["item"] ?? null)]);
        // line 35
        yield "    <a href=\"#\" onclick=\"plugin_formcreator.showSectionForm(";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_2 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 35)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["plugin_formcreator_forms_id"] ?? null) : null), "html", null, true);
        yield ", ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_3 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 35)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["id"] ?? null) : null), "html", null, true);
        yield ")\" data-field=\"name\">
        ";
        // line 37
        yield "        <sup class=\"plugin_formcreator_conditions_count\" title=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Count of conditions", "formcreator"), "html", null, true);
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["conditionsCount"] ?? null), "html", null, true);
        yield "</sup>
        ";
        // line 38
        if (Twig\Extension\CoreExtension::testEmpty((($__internal_compile_4 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 38)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["name"] ?? null) : null))) {
            // line 39
            yield "            ";
            $context["name"] = (("(" . (($__internal_compile_5 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 39)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["id"] ?? null) : null)) . ")");
            // line 40
            yield "        ";
        } else {
            // line 41
            yield "            ";
            $context["name"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Glpi\\Toolbox\\Sanitizer::unsanitize", [(($__internal_compile_6 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 41)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["name"] ?? null) : null)]);
            // line 42
            yield "        ";
        }
        // line 43
        yield "        <span>";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["name"] ?? null), "html", null, true);
        yield "</span>
    </a>

    ";
        // line 47
        yield "    <span class='form_control pointer'>
    <i class=\"far fa-trash-alt\" onclick=\"plugin_formcreator.deleteSection(this)\"></i>
    </span>

    ";
        // line 52
        yield "    <span class='form_control pointer'>
    <i class=\"far fa-clone\" onclick=\"plugin_formcreator.duplicateSection(this)\"></i>
    </span>

    ";
        // line 57
        yield "    ";
        if ((-1 === CoreExtension::compare((($__internal_compile_7 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 57)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["order"] ?? null) : null), ($context["lastSectionOrder"] ?? null)))) {
            // line 58
            yield "        ";
            $context["display"] = "initial";
            // line 59
            yield "    ";
        } else {
            // line 60
            yield "        ";
            $context["display"] = "none";
            // line 61
            yield "    ";
        }
        // line 62
        yield "    <span class=\"form_control pointer moveDown\" style=\"display: ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["display"] ?? null), "html", null, true);
        yield "\">
      <i class=\"fas fa-sort-down\" onclick=\"plugin_formcreator.moveSection(this, 'down')\"></i>
    </span>

    ";
        // line 67
        yield "    ";
        if ((1 === CoreExtension::compare((($__internal_compile_8 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 67)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["order"] ?? null) : null), 1))) {
            // line 68
            yield "        ";
            $context["display"] = "initial";
            // line 69
            yield "    ";
        } else {
            // line 70
            yield "        ";
            $context["display"] = "none";
            // line 71
            yield "    ";
        }
        // line 72
        yield "    <span class=\"form_control pointer moveUp\" style=\"display: ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["display"] ?? null), "html", null, true);
        yield "\">
    <i class=\"fas fa-sort-up\" onclick=\"plugin_formcreator.moveSection(this, 'up')\"></i>
    </span>

    ";
        // line 77
        yield "    ";
        $context["columns"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("constant", ["PluginFormcreatorSection::COLUMNS"]);
        // line 78
        yield "    <div class=\"grid-stack grid-stack-";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["columns"] ?? null), "html", null, true);
        yield "\" data-gs-animate=\"yes\" data-gs-width=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["columns"] ?? null), "html", null, true);
        yield "\" data-id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_9 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 78)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["id"] ?? null) : null), "html", null, true);
        yield "\"></div>

    ";
        // line 81
        yield "    <div class=\"plugin_formcreator_question\">
        <a href=\"#\" onclick=\"plugin_formcreator.showQuestionForm(";
        // line 82
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_10 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 82)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["id"] ?? null) : null), "html", null, true);
        yield ");\">
            <i class=\"fas fa-plus\"></i>&nbsp;";
        // line 83
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Add a question", "formcreator"), "html", null, true);
        yield "
        </a>
    </div>
    <script type=\"text/javascript\">
        \$(function () {
            plugin_formcreator.initGridStack(";
        // line 88
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_11 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 88)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["id"] ?? null) : null), "html", null, true);
        yield ");
         });
    </script>
</li>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@formcreator/components/form/section_design.html.twig";
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
        return array (  173 => 88,  165 => 83,  161 => 82,  158 => 81,  148 => 78,  145 => 77,  137 => 72,  134 => 71,  131 => 70,  128 => 69,  125 => 68,  122 => 67,  114 => 62,  111 => 61,  108 => 60,  105 => 59,  102 => 58,  99 => 57,  93 => 52,  87 => 47,  80 => 43,  77 => 42,  74 => 41,  71 => 40,  68 => 39,  66 => 38,  59 => 37,  52 => 35,  50 => 34,  46 => 33,  43 => 32,  41 => 31,  38 => 30,);
    }

    public function getSourceContext()
    {
        return new Source("", "@formcreator/components/form/section_design.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\plugins\\formcreator\\templates\\components\\form\\section_design.html.twig");
    }
}
