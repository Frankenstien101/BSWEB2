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

/* @formcreator/pages/question.html.twig */
class __TwigTemplate_c4bce7ba0e8112b54c8413e1decc02eb994879ba4f715d54e0f4967ceee050be extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'form_fields' => [$this, 'block_form_fields'],
            'questionFields' => [$this, 'block_questionFields'],
            'questionParameters' => [$this, 'block_questionParameters'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 31
        return "generic_show_form.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 32
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/pages/question.html.twig", 32)->unwrap();
        // line 33
        $macros["formcreatorFields"] = $this->macros["formcreatorFields"] = $this->loadTemplate("@formcreator/components/form/fields_macros.html.twig", "@formcreator/pages/question.html.twig", 33)->unwrap();
        // line 31
        $this->parent = $this->loadTemplate("generic_show_form.html.twig", "@formcreator/pages/question.html.twig", 31);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 35
    public function block_form_fields($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 36
        yield "   ";
        yield CoreExtension::callMacro($macros["fields"], "macro_autoNameField", ["name",         // line 38
($context["item"] ?? null), __("Name"),         // line 40
($context["withtemplate"] ?? null), ["value" => (($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source,         // line 42
($context["item"] ?? null), "fields", [], "any", false, false, false, 42)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["name"] ?? null) : null), "required" => true, "label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 36, $context, $this->getSourceContext());
        // line 46
        yield "

   ";
        // line 48
        $context["section"] = $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItem("PluginFormcreatorSection", (($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 48)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["plugin_formcreator_sections_id"] ?? null) : null));
        // line 49
        yield "   ";
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["PluginFormcreatorSection", "plugin_formcreator_sections_id", (($__internal_compile_2 = CoreExtension::getAttribute($this->env, $this->source,         // line 52
($context["item"] ?? null), "fields", [], "any", false, false, false, 52)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["plugin_formcreator_sections_id"] ?? null) : null), _n("Section", "Sections", 1, "formcreator"), ["display_emptychoice" => false, "condition" => ["plugin_formcreator_forms_id" => (($__internal_compile_3 = CoreExtension::getAttribute($this->env, $this->source,         // line 56
($context["section"] ?? null), "fields", [], "any", false, false, false, 56)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["plugin_formcreator_forms_id"] ?? null) : null)], "label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 49, $context, $this->getSourceContext());
        // line 60
        yield "

   ";
        // line 62
        yield CoreExtension::callMacro($macros["formcreatorFields"], "macro_dropdownQuestionType", ["fieldtype", (($__internal_compile_4 = CoreExtension::getAttribute($this->env, $this->source,         // line 64
($context["item"] ?? null), "fields", [], "any", false, false, false, 64)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["fieldtype"] ?? null) : null), _n("Type", "Types", 1), ["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 62, $context, $this->getSourceContext());
        // line 70
        yield "

   ";
        // line 72
        yield from $this->unwrap()->yieldBlock('questionFields', $context, $blocks);
        // line 108
        yield "
   ";
        // line 109
        if ( !(null === (($__internal_compile_5 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 109)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["fieldtype"] ?? null) : null))) {
            // line 110
            yield "      ";
            yield CoreExtension::callMacro($macros["fields"], "macro_textareaField", ["description", (($__internal_compile_6 = CoreExtension::getAttribute($this->env, $this->source,             // line 112
($context["item"] ?? null), "fields", [], "any", false, false, false, 112)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["description"] ?? null) : null), __("Description"), ["full_width" => true, "full_width_adapt_column" => false, "label_class" => "col-xxl-2", "input_class" => "col-xxl-10", "enable_richtext" => true]], 110, $context, $this->getSourceContext());
            // line 120
            yield "

      ";
            // line 122
            if ((1 === CoreExtension::compare(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["question_params"] ?? null)), 0))) {
                // line 123
                yield "         ";
                yield from $this->unwrap()->yieldBlock('questionParameters', $context, $blocks);
                // line 125
                yield "      ";
            }
            // line 126
            yield "
      ";
            // line 127
            yield CoreExtension::callMacro($macros["fields"], "macro_smallTitle", [__("Condition to show the question", "formcreator")], 127, $context, $this->getSourceContext());
            yield "

      ";
            // line 129
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownArrayField", ["show_rule", (($__internal_compile_7 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 129)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["show_rule"] ?? null) : null), CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getEnumShowrule", [], "method", false, false, false, 129), "", ["no_label" => true, "on_change" => "plugin_formcreator_toggleCondition(this);"]], 129, $context, $this->getSourceContext());
            yield "
      ";
            // line 130
            $context["parent"] = ($context["item"] ?? null);
            // line 131
            yield "      ";
            $context["conditions"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorCondition::getConditionsFromItem", [($context["item"] ?? null)]);
            // line 132
            yield "      ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["conditions"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["condition"]) {
                // line 133
                yield "         ";
                yield Twig\Extension\CoreExtension::include($this->env, $context, "@formcreator/components/form/condition.html.twig");
                yield "
      ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['condition'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 135
            yield "   ";
        }
        return; yield '';
    }

    // line 72
    public function block_questionFields($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 73
        yield "      ";
        yield CoreExtension::callMacro($macros["fields"], "macro_nullField", [["add_field_class" => "plugin_formcreator_subtype"]], 73, $context, $this->getSourceContext());
        yield "

      ";
        // line 75
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownYesNo", ["required", (($__internal_compile_8 = CoreExtension::getAttribute($this->env, $this->source,         // line 77
($context["item"] ?? null), "fields", [], "any", false, false, false, 77)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["required"] ?? null) : null), __("Required", "formcreator"), ["add_field_class" => "plugin_formcreator_required", "label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 75, $context, $this->getSourceContext());
        // line 84
        yield "

      ";
        // line 86
        yield CoreExtension::callMacro($macros["fields"], "macro_nullField", [["add_field_class" => "plugin_formcreator_empty", "label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 86, $context, $this->getSourceContext());
        // line 90
        yield "

      ";
        // line 92
        if ((0 === CoreExtension::compare(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["additions"] ?? null)), 0))) {
            // line 93
            yield "         ";
            yield CoreExtension::callMacro($macros["fields"], "macro_nullField", [["add_field_class" => "plugin_formcreator_additions", "label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 93, $context, $this->getSourceContext());
            // line 97
            yield "
      ";
        } else {
            // line 99
            yield "         ";
            yield ($context["additions"] ?? null);
            yield "
      ";
        }
        // line 101
        yield "
      ";
        // line 103
        yield "      ";
        yield CoreExtension::callMacro($macros["fields"], "macro_nullField", [["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 103, $context, $this->getSourceContext());
        // line 106
        yield "
   ";
        return; yield '';
    }

    // line 123
    public function block_questionParameters($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "         ";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@formcreator/pages/question.html.twig";
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
        return array (  217 => 123,  211 => 106,  208 => 103,  205 => 101,  199 => 99,  195 => 97,  192 => 93,  190 => 92,  186 => 90,  184 => 86,  180 => 84,  178 => 77,  177 => 75,  171 => 73,  167 => 72,  161 => 135,  144 => 133,  126 => 132,  123 => 131,  121 => 130,  117 => 129,  112 => 127,  109 => 126,  106 => 125,  103 => 123,  101 => 122,  97 => 120,  95 => 112,  93 => 110,  91 => 109,  88 => 108,  86 => 72,  82 => 70,  80 => 64,  79 => 62,  75 => 60,  73 => 56,  72 => 52,  70 => 49,  68 => 48,  64 => 46,  62 => 42,  61 => 40,  60 => 38,  58 => 36,  54 => 35,  49 => 31,  47 => 33,  45 => 32,  38 => 31,);
    }

    public function getSourceContext()
    {
        return new Source("", "@formcreator/pages/question.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\plugins\\formcreator\\templates\\pages\\question.html.twig");
    }
}
