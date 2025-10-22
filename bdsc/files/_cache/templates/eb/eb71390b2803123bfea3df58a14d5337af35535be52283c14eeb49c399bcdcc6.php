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

/* components/dashboard/widget_form.html.twig */
class __TwigTemplate_8c72a40d5264dbf923b15b1a42a6237bb84dcbbb9050945abdc09472aa7544f9 extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/dashboard/widget_form.html.twig", 34)->unwrap();
        // line 35
        yield "
";
        // line 36
        $context["field_options"] = ["full_width" => true];
        // line 39
        yield "
";
        // line 40
        $context["rand"] = Twig\Extension\CoreExtension::random($this->env->getCharset());
        // line 41
        yield "
<form class=\"display-widget-form\">

   <input type=\"hidden\" name=\"gridstack_id\" value=\"";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["gridstack_id"] ?? null), "html", null, true);
        yield "\" />
   <input type=\"hidden\" name=\"old_id\" value=\"";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["old_id"] ?? null), "html", null, true);
        yield "\" />
   <input type=\"hidden\" name=\"x\" value=\"";
        // line 46
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["x"] ?? null), "html", null, true);
        yield "\" />
   <input type=\"hidden\" name=\"y\" value=\"";
        // line 47
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["y"] ?? null), "html", null, true);
        yield "\" />
   <input type=\"hidden\" name=\"width\" value=\"";
        // line 48
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["width"] ?? null), "html", null, true);
        yield "\" />
   <input type=\"hidden\" name=\"height\" value=\"";
        // line 49
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["height"] ?? null), "html", null, true);
        yield "\" />
   <input type=\"hidden\" name=\"card_options\" value=\"";
        // line 50
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(json_encode(($context["card_options"] ?? null), Twig\Extension\CoreExtension::constant("JSON_HEX_QUOT")), "html", null, true);
        yield "\" />

   ";
        // line 52
        yield CoreExtension::callMacro($macros["fields"], "macro_colorField", ["color",         // line 54
($context["color"] ?? null), __("Background color"),         // line 56
($context["field_options"] ?? null)], 52, $context, $this->getSourceContext());
        // line 57
        yield "

   ";
        // line 59
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownArrayField", ["card_id",         // line 61
($context["card_id"] ?? null),         // line 62
($context["list_cards"] ?? null), __("Data"), Twig\Extension\CoreExtension::merge(        // line 64
($context["field_options"] ?? null), ["display_emptychoice" =>  !        // line 65
($context["edit"] ?? null)])], 59, $context, $this->getSourceContext());
        // line 67
        yield "

   ";
        // line 70
        yield "   ";
        $context["widgets_list"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 71
            yield "      <div class=\"widget-list\">
         ";
            // line 72
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["widget_types"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["current"]) {
                // line 73
                yield "            ";
                $context["selected"] = (0 === CoreExtension::compare($context["key"], ($context["widgettype"] ?? null)));
                // line 74
                yield "            ";
                $context["w_displayed"] = ((($context["edit"] ?? null) && CoreExtension::getAttribute($this->env, $this->source, ($context["card"] ?? null), "widgettype", [], "array", true, true, false, 74)) && CoreExtension::inFilter($context["key"], (($__internal_compile_0 = ($context["card"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["widgettype"] ?? null) : null)));
                // line 75
                yield "
            <input type=\"radio\"
                  ";
                // line 77
                if (($context["selected"] ?? null)) {
                    yield "checked=\"checked\"";
                }
                // line 78
                yield "                  class=\"widget-select\" id=\"widgettype_";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
                yield "_";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
                yield "\"
                  name=\"widgettype\"
                  value=\"";
                // line 80
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
                yield "\" />
               <label for=\"widgettype_";
                // line 81
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
                yield "_";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
                yield "\"
                      ";
                // line 82
                if (($context["w_displayed"] ?? null)) {
                    yield "style=\"display: inline-block;\"";
                }
                yield ">
                  <div>";
                // line 83
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_1 = $context["current"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["label"] ?? null) : null), "html", null, true);
                yield "</div>
                  <img src=\"";
                // line 84
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_2 = $context["current"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["image"] ?? null) : null), "html", null, true);
                yield "\" />
               </label>
         ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['current'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 87
            yield "      </div>
   ";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 89
        yield "
   ";
        // line 90
        $context["displayed"] = ($context["edit"] ?? null);
        // line 91
        yield "   <div class=\"widgettype_field\" ";
        if ( !($context["displayed"] ?? null)) {
            yield "style=\"display: none;\"";
        }
        yield ">
      ";
        // line 92
        yield CoreExtension::callMacro($macros["fields"], "macro_field", ["",         // line 94
($context["widgets_list"] ?? null), __("Widget"),         // line 96
($context["field_options"] ?? null)], 92, $context, $this->getSourceContext());
        // line 97
        yield "
   </div>

   ";
        // line 101
        yield "   ";
        $context["gradient_displayed"] = (($context["edit"] ?? null) && ((CoreExtension::getAttribute($this->env, $this->source, ($context["widget_def"] ?? null), "gradient", [], "array", true, true, false, 101)) ? (Twig\Extension\CoreExtension::default((($__internal_compile_3 = ($context["widget_def"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["gradient"] ?? null) : null), false)) : (false)));
        // line 102
        yield "   <div class=\"gradient_field\" ";
        if ( !($context["gradient_displayed"] ?? null)) {
            yield "style=\"display: none;\"";
        }
        yield ">
      ";
        // line 103
        yield CoreExtension::callMacro($macros["fields"], "macro_checkboxField", ["use_gradient",         // line 105
($context["use_gradient"] ?? null), __("Use gradient palette"),         // line 107
($context["field_options"] ?? null)], 103, $context, $this->getSourceContext());
        // line 108
        yield "
   </div>

   ";
        // line 112
        yield "   ";
        $context["point_labels_displayed"] = (($context["edit"] ?? null) && ((CoreExtension::getAttribute($this->env, $this->source, ($context["widget_def"] ?? null), "pointlbl", [], "array", true, true, false, 112)) ? (Twig\Extension\CoreExtension::default((($__internal_compile_4 = ($context["widget_def"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["pointlbl"] ?? null) : null), false)) : (false)));
        // line 113
        yield "   <div class=\"pointlbl_field\" ";
        if ( !($context["point_labels_displayed"] ?? null)) {
            yield "style=\"display: none;\"";
        }
        yield ">
      ";
        // line 114
        yield CoreExtension::callMacro($macros["fields"], "macro_checkboxField", ["point_labels",         // line 116
($context["point_labels"] ?? null), __("Display value labels on points/bars"),         // line 118
($context["field_options"] ?? null)], 114, $context, $this->getSourceContext());
        // line 119
        yield "
   </div>

   ";
        // line 123
        yield "   ";
        $context["limit_displayed"] = (($context["edit"] ?? null) && ((CoreExtension::getAttribute($this->env, $this->source, ($context["widget_def"] ?? null), "limit", [], "array", true, true, false, 123)) ? (Twig\Extension\CoreExtension::default((($__internal_compile_5 = ($context["widget_def"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["limit"] ?? null) : null), false)) : (false)));
        // line 124
        yield "   <div class=\"limit_field\" ";
        if ( !($context["limit_displayed"] ?? null)) {
            yield "style=\"display: none;\"";
        }
        yield ">
      ";
        // line 125
        yield CoreExtension::callMacro($macros["fields"], "macro_numberField", ["limit",         // line 127
($context["limit"] ?? null), __("Limit number of data"),         // line 129
($context["field_options"] ?? null)], 125, $context, $this->getSourceContext());
        // line 130
        yield "
   </div>

   <div class=\"modal-footer\">
      <button type=\"submit\" class=\"btn btn-primary ";
        // line 134
        yield ((($context["edit"] ?? null)) ? ("edit-widget") : ("add-widget"));
        yield "\">
         ";
        // line 135
        if (($context["edit"] ?? null)) {
            // line 136
            yield "            <i class=\"far fa-save\"></i>
            <span>";
            // line 137
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Update"), "html", null, true);
            yield "</span>
         ";
        } else {
            // line 139
            yield "            <i class=\"fas fa-plus\"></i>
            <span>";
            // line 140
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Add"), "html", null, true);
            yield "</span>
         ";
        }
        // line 142
        yield "      </button>
   </div>

</form>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/dashboard/widget_form.html.twig";
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
        return array (  272 => 142,  267 => 140,  264 => 139,  259 => 137,  256 => 136,  254 => 135,  250 => 134,  244 => 130,  242 => 129,  241 => 127,  240 => 125,  233 => 124,  230 => 123,  225 => 119,  223 => 118,  222 => 116,  221 => 114,  214 => 113,  211 => 112,  206 => 108,  204 => 107,  203 => 105,  202 => 103,  195 => 102,  192 => 101,  187 => 97,  185 => 96,  184 => 94,  183 => 92,  176 => 91,  174 => 90,  171 => 89,  166 => 87,  157 => 84,  153 => 83,  147 => 82,  141 => 81,  137 => 80,  129 => 78,  125 => 77,  121 => 75,  118 => 74,  115 => 73,  111 => 72,  108 => 71,  105 => 70,  101 => 67,  99 => 65,  98 => 64,  97 => 62,  96 => 61,  95 => 59,  91 => 57,  89 => 56,  88 => 54,  87 => 52,  82 => 50,  78 => 49,  74 => 48,  70 => 47,  66 => 46,  62 => 45,  58 => 44,  53 => 41,  51 => 40,  48 => 39,  46 => 36,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/dashboard/widget_form.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\dashboard\\widget_form.html.twig");
    }
}
