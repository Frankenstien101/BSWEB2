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

/* @formcreator/field/undefinedfield.html.twig */
class __TwigTemplate_c1f4ba4546fecfc108e2aefb5d3cf4aa8ee95ccea84185ffdefa63915f3be276 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'questionFields' => [$this, 'block_questionFields'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 34
        return "@formcreator/pages/question.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 35
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/field/undefinedfield.html.twig", 35)->unwrap();
        // line 36
        $macros["formcreatorFields"] = $this->macros["formcreatorFields"] = $this->loadTemplate("@formcreator/components/form/fields_macros.html.twig", "@formcreator/field/undefinedfield.html.twig", 36)->unwrap();
        // line 34
        $this->parent = $this->loadTemplate("@formcreator/pages/question.html.twig", "@formcreator/field/undefinedfield.html.twig", 34);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 38
    public function block_questionFields($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 39
        yield "    ";
        yield CoreExtension::callMacro($macros["fields"], "macro_smallTitle", [CoreExtension::getAttribute($this->env, $this->source, ($context["params"] ?? null), "error", [], "any", false, false, false, 39)], 39, $context, $this->getSourceContext());
        yield "
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@formcreator/field/undefinedfield.html.twig";
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
        return array (  56 => 39,  52 => 38,  47 => 34,  45 => 36,  43 => 35,  36 => 34,);
    }

    public function getSourceContext()
    {
        return new Source("", "@formcreator/field/undefinedfield.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\plugins\\formcreator\\templates\\field\\undefinedfield.html.twig");
    }
}
