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

/* components/itilobject/actors/assign_to_me.html.twig */
class __TwigTemplate_403b35b2dc4a7143a2f20b1d9013de0ffc76dc59afb98ba217236108db5ffcfe extends Template
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
<button type=\"submit\"
        form=\"addme_as_";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["actortype"] ?? null), "html", null, true);
        yield "_";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["main_rand"] ?? null), "html", null, true);
        yield "\"
        name=\"id\"
        value=\"";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 37)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["id"] ?? null) : null), "html", null, true);
        yield "\"
        class=\"btn btn-icon btn-sm btn-ghost-secondary float-end mt-1 ms-1\"
        title=\"";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Associate myself"), "html", null, true);
        yield "\"
        data-bs-toggle=\"tooltip\" data-bs-placement=\"top\">
   <i class=\"fas fa-male\"></i>
</button>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/itilobject/actors/assign_to_me.html.twig";
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
        return array (  54 => 39,  49 => 37,  42 => 35,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/actors/assign_to_me.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\actors\\assign_to_me.html.twig");
    }
}
