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

/* @formcreator/pages/section.html.twig */
class __TwigTemplate_e9a862bad7df74bc86b435906be96a0f9d619a61b50e283e33b6470e51a7ce61 extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/pages/section.html.twig", 31)->unwrap();
        // line 32
        yield "
";
        // line 33
        $context["bg"] = "";
        // line 34
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isDeleted", [], "method", false, false, false, 34)) {
            // line 35
            yield "   ";
            $context["bg"] = "asset-deleted";
        }
        // line 37
        yield "
<div class=\"asset ";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["bg"] ?? null), "html", null, true);
        yield "\">
   ";
        // line 39
        yield Twig\Extension\CoreExtension::include($this->env, $context, "components/form/header.html.twig");
        yield "

   ";
        // line 41
        $context["rand"] = Twig\Extension\CoreExtension::random($this->env->getCharset());
        // line 42
        yield "   ";
        $context["params"] = (($context["params"]) ?? ([]));
        // line 43
        yield "   ";
        $context["target"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "target", [], "array", true, true, false, 43) &&  !(null === (($__internal_compile_0 = ($context["params"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["target"] ?? null) : null)))) ? ((($__internal_compile_1 = ($context["params"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["target"] ?? null) : null)) : (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getFormURL", [], "method", false, false, false, 43)));
        // line 44
        yield "   ";
        $context["withtemplate"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "withtemplate", [], "array", true, true, false, 44) &&  !(null === (($__internal_compile_2 = ($context["params"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["withtemplate"] ?? null) : null)))) ? ((($__internal_compile_3 = ($context["params"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["withtemplate"] ?? null) : null)) : (""));
        // line 45
        yield "   ";
        $context["item_type"] = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 45);
        // line 46
        yield "   ";
        $context["item_has_pictures"] = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "hasItemtypeOrModelPictures", [], "method", false, false, false, 46);
        // line 47
        yield "
   <div class=\"card-body d-flex flex-wrap\">
      <div class=\"col-12 col-xxl-";
        // line 49
        yield ((($context["item_has_pictures"] ?? null)) ? ("9") : ("12"));
        yield " flex-column\">
         <div class=\"d-flex flex-row flex-wrap flex-xl-nowrap\">
            <div class=\"row flex-row align-items-start flex-grow-1\">
               <div class=\"row flex-row\">

                    ";
        // line 54
        yield CoreExtension::callMacro($macros["fields"], "macro_autoNameField", ["name",         // line 56
($context["item"] ?? null), __("Name"),         // line 58
($context["withtemplate"] ?? null), ["required" => true]], 54, $context, $this->getSourceContext());
        // line 60
        yield "

                    ";
        // line 62
        yield CoreExtension::callMacro($macros["fields"], "macro_hiddenField", ["plugin_formcreator_forms_id", (($__internal_compile_4 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 62)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["plugin_formcreator_forms_id"] ?? null) : null), "", ["include_field" => false]], 62, $context, $this->getSourceContext());
        yield "

                    ";
        // line 64
        yield CoreExtension::callMacro($macros["fields"], "macro_smallTitle", [__("Condition to show the section", "formcreator")], 64, $context, $this->getSourceContext());
        yield "

                    ";
        // line 66
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownArrayField", ["show_rule", (($__internal_compile_5 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 66)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["show_rule"] ?? null) : null), CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getEnumShowrule", [], "method", false, false, false, 66), "", ["no_label" => true, "on_change" => "plugin_formcreator_toggleCondition(this);"]], 66, $context, $this->getSourceContext());
        yield "
                    ";
        // line 67
        $context["parent"] = ($context["item"] ?? null);
        // line 68
        yield "                    ";
        $context["conditions"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorCondition::getConditionsFromItem", [($context["item"] ?? null)]);
        // line 69
        yield "                    ";
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
            // line 70
            yield "                        ";
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
        // line 72
        yield "               </div> ";
        // line 73
        yield "            </div> ";
        // line 74
        yield "         </div> ";
        // line 75
        yield "      </div>

      ";
        // line 77
        if (($context["item_has_pictures"] ?? null)) {
            // line 78
            yield "         <div class=\"col-12 col-xxl-3 flex-column\">
            <div class=\"flex-row asset-pictures\">
               ";
            // line 80
            yield Twig\Extension\CoreExtension::include($this->env, $context, "components/form/pictures.html.twig", ["gallery_type" => ""]);
            yield "
            </div>
         </div>
      ";
        }
        // line 84
        yield "   </div> ";
        // line 85
        yield "
   ";
        // line 86
        yield Twig\Extension\CoreExtension::include($this->env, $context, "components/form/buttons.html.twig");
        yield "

   ";
        // line 88
        if ((0 === CoreExtension::compare((($__internal_compile_6 = ($context["params"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["formfooter"] ?? null) : null), null))) {
            // line 89
            yield "      <div class=\"card-footer mx-n2 mb-n2 mt-4\">
         ";
            // line 90
            yield Twig\Extension\CoreExtension::include($this->env, $context, "components/form/dates.html.twig");
            yield "
      </div>
   ";
        }
        // line 93
        yield "</div>";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@formcreator/pages/section.html.twig";
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
        return array (  201 => 93,  195 => 90,  192 => 89,  190 => 88,  185 => 86,  182 => 85,  180 => 84,  173 => 80,  169 => 78,  167 => 77,  163 => 75,  161 => 74,  159 => 73,  157 => 72,  140 => 70,  122 => 69,  119 => 68,  117 => 67,  113 => 66,  108 => 64,  103 => 62,  99 => 60,  97 => 58,  96 => 56,  95 => 54,  87 => 49,  83 => 47,  80 => 46,  77 => 45,  74 => 44,  71 => 43,  68 => 42,  66 => 41,  61 => 39,  57 => 38,  54 => 37,  50 => 35,  48 => 34,  46 => 33,  43 => 32,  41 => 31,  38 => 30,);
    }

    public function getSourceContext()
    {
        return new Source("", "@formcreator/pages/section.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\plugins\\formcreator\\templates\\pages\\section.html.twig");
    }
}
