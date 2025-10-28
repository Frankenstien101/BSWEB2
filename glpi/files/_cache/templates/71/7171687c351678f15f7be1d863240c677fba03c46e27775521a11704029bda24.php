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

/* @formcreator/questionparameter/regex.html.twig */
class __TwigTemplate_258f4466c4b6b7f461c808fa4dcade7b3199968a473540d04ffab5c42c821d47 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'parameters' => [$this, 'block_parameters'],
        ];
        $macros["_self"] = $this->macros["_self"] = $this;
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 30
        yield "

";
        // line 32
        yield from $this->unwrap()->yieldBlock('parameters', $context, $blocks);
        // line 35
        yield "
";
        return; yield '';
    }

    // line 32
    public function block_parameters($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 33
        yield "    ";
        yield CoreExtension::callMacro($macros["_self"], "macro_regexField", [CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "name", [], "any", false, false, false, 33), ($context["item"] ?? null), ($context["label"] ?? null)], 33, $context, $this->getSourceContext());
        yield "
";
        return; yield '';
    }

    // line 36
    public function macro_regexField($__name__ = null, $__item__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "item" => $__item__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 37
            yield "    ";
            $macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/questionparameter/regex.html.twig", 37)->unwrap();
            // line 38
            yield "
    ";
            // line 39
            yield CoreExtension::callMacro($macros["fields"], "macro_textField", [(            // line 40
($context["name"] ?? null) . "[regex]"), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 41
($context["item"] ?? null), "fields", [], "any", false, false, false, 41), "regex", [], "any", false, false, false, 41), __("Regular expression", "formcreator"), ["rand" => "", "label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 39, $context, $this->getSourceContext());
            // line 48
            yield "

     ";
            // line 50
            yield CoreExtension::callMacro($macros["fields"], "macro_nullField", [["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]], 50, $context, $this->getSourceContext());
            // line 53
            yield "
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@formcreator/questionparameter/regex.html.twig";
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
        return array (  95 => 53,  93 => 50,  89 => 48,  87 => 41,  86 => 40,  85 => 39,  82 => 38,  79 => 37,  64 => 36,  56 => 33,  52 => 32,  46 => 35,  44 => 32,  40 => 30,);
    }

    public function getSourceContext()
    {
        return new Source("", "@formcreator/questionparameter/regex.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\plugins\\formcreator\\templates\\questionparameter\\regex.html.twig");
    }
}
