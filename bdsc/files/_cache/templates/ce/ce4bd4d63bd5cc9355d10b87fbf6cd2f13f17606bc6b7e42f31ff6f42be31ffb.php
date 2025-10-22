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

/* @formcreator/pages/condition_for_item.html.twig */
class __TwigTemplate_6bddf07d7f40e3046df689d6176eae30e542b9a92bc7caba70f0044115941188 extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/pages/condition_for_item.html.twig", 31)->unwrap();
        // line 32
        yield "
<div id=\"plugin_formcreator_form\" class=\"asset plugin_formcreator_form_design\" data-itemtype=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "any", false, false, false, 33), "html", null, true);
        yield "\" data-id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 33)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["id"] ?? null) : null), "html", null, true);
        yield "\">
   ";
        // line 34
        yield Twig\Extension\CoreExtension::include($this->env, $context, "components/form/header.html.twig");
        yield "
    <div class=\"card-body d-flex flex-wrap\">
        <div class=\"col-12 col-xxl-";
        // line 36
        yield ((($context["item_has_pictures"] ?? null)) ? ("9") : ("12"));
        yield " flex-column\">
            <div class=\"d-flex flex-row flex-wrap flex-xl-nowrap\">
                <div class=\"row flex-row align-items-start flex-grow-1\">
                    <div class=\"row flex-row\">
                        ";
        // line 40
        yield CoreExtension::callMacro($macros["fields"], "macro_smallTitle", [__("Condition to generate the target", "formcreator")], 40, $context, $this->getSourceContext());
        yield "

                        ";
        // line 42
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownArrayField", ["show_rule", (($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 42)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["show_rule"] ?? null) : null), CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getEnumShowrule", [], "method", false, false, false, 42), "", ["no_label" => true, "on_change" => "plugin_formcreator_toggleCondition(this);"]], 42, $context, $this->getSourceContext());
        yield "
                        ";
        // line 43
        $context["conditions"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorCondition::getConditionsFromItem", [($context["item"] ?? null)]);
        // line 44
        yield "                        ";
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
            // line 45
            yield "                            ";
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
        // line 47
        yield "                    </div> ";
        // line 48
        yield "                </div> ";
        // line 49
        yield "            </div> ";
        // line 50
        yield "        </div>
    </div>
    ";
        // line 52
        yield Twig\Extension\CoreExtension::include($this->env, $context, "components/form/buttons.html.twig");
        yield "
</div>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@formcreator/pages/condition_for_item.html.twig";
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
        return array (  120 => 52,  116 => 50,  114 => 49,  112 => 48,  110 => 47,  93 => 45,  75 => 44,  73 => 43,  69 => 42,  64 => 40,  57 => 36,  52 => 34,  46 => 33,  43 => 32,  41 => 31,  38 => 30,);
    }

    public function getSourceContext()
    {
        return new Source("", "@formcreator/pages/condition_for_item.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\plugins\\formcreator\\templates\\pages\\condition_for_item.html.twig");
    }
}
