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

/* @formcreator/field/textareafield.html.twig */
class __TwigTemplate_d304eba134e498fb8d6ed1f7c9f0925e4b867fc387c25b0250b6cc76a34d61f1 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'questionFields' => [$this, 'block_questionFields'],
            'questionParameters' => [$this, 'block_questionParameters'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 30
        return "@formcreator/pages/question.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 31
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/field/textareafield.html.twig", 31)->unwrap();
        // line 32
        $macros["formcreatorFields"] = $this->macros["formcreatorFields"] = $this->loadTemplate("@formcreator/components/form/fields_macros.html.twig", "@formcreator/field/textareafield.html.twig", 32)->unwrap();
        // line 30
        $this->parent = $this->loadTemplate("@formcreator/pages/question.html.twig", "@formcreator/field/textareafield.html.twig", 30);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 34
    public function block_questionFields($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 35
        yield "    ";
        yield CoreExtension::callMacro($macros["fields"], "macro_nullField", [["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 35, $context, $this->getSourceContext());
        // line 38
        yield "

    ";
        // line 40
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownYesNo", ["required", (($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source,         // line 42
($context["item"] ?? null), "fields", [], "any", false, false, false, 42)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["required"] ?? null) : null), __("Required", "formcreator"), ["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 40, $context, $this->getSourceContext());
        // line 47
        yield "

    ";
        // line 49
        yield CoreExtension::callMacro($macros["fields"], "macro_nullField", [["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 49, $context, $this->getSourceContext());
        // line 52
        yield "

    ";
        // line 54
        yield CoreExtension::callMacro($macros["fields"], "macro_textareaField", ["default_values", (($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source,         // line 56
($context["item"] ?? null), "fields", [], "any", false, false, false, 56)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["default_values"] ?? null) : null), __("Default values"), ["full_width" => true, "full_width_adapt_column" => false, "enable_richtext" => true, "label_class" => "col-xxl-2", "input_class" => "col-xxl-10"]], 54, $context, $this->getSourceContext());
        // line 65
        yield "
";
        return; yield '';
    }

    // line 68
    public function block_questionParameters($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 69
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["question_params"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["parameter"]) {
            // line 70
            yield "        ";
            yield CoreExtension::getAttribute($this->env, $this->source, $context["parameter"], "getParameterForm", [($context["item"] ?? null)], "method", false, false, false, 70);
            yield "
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['parameter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@formcreator/field/textareafield.html.twig";
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
        return array (  95 => 70,  90 => 69,  86 => 68,  80 => 65,  78 => 56,  77 => 54,  73 => 52,  71 => 49,  67 => 47,  65 => 42,  64 => 40,  60 => 38,  57 => 35,  53 => 34,  48 => 30,  46 => 32,  44 => 31,  37 => 30,);
    }

    public function getSourceContext()
    {
        return new Source("", "@formcreator/field/textareafield.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\plugins\\formcreator\\templates\\field\\textareafield.html.twig");
    }
}
