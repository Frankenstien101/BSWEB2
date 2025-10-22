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

/* @formcreator/pages/form.formanswer.html.twig */
class __TwigTemplate_d2d0c8ab43073f074351c1af425ffd85c26db51b52cde2d025c37a8ff94dc9ba extends Template
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
        if ((-1 === CoreExtension::compare(($context["total_count"] ?? null), 1))) {
            // line 32
            yield "   <div class=\"alert alert-info\">
      ";
            // line 33
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("No form answer yet", "formcreator"), "html", null, true);
            yield "
   </div>
";
        } else {
            // line 36
            yield "   ";
            $context["criteria"] = (("?criteria[0][field]=3&criteria[0][searchtype]=equals&criteria[0][value]=" . CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "getID", [], "method", false, false, false, 36)) . "");
            // line 37
            yield "   <div class=\"center my-4\">
      ";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::sprintf(__("%s latest items", "formcreator"), ($context["total_count"] ?? null)), "html", null, true);
            yield "
      <a href=\"";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeSearchPath("PluginFormcreatorFormAnswer") . ($context["criteria"] ?? null)), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("See all", "formcreator"), "html", null, true);
            yield "</a>
   </div>
   <div class=\"table-responsive\">
      <table class=\"table table-hover\">
         <thead>
            <tr>
               <th>";
            // line 45
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("ID"), "html", null, true);
            yield "</th>
               <th>";
            // line 46
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Name"), "html", null, true);
            yield "</th>
               <th>";
            // line 47
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Form", "Forms", 1, "formcreator"), "html", null, true);
            yield "</th>
               <th>";
            // line 48
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Requester", "Requesters", 1), "html", null, true);
            yield "</th>
               <th>";
            // line 49
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Creation date"), "html", null, true);
            yield "</th>
            </tr>
         </thead>
         <tbody>
            ";
            // line 53
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["form_answers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 54
                yield "               <tr>
                  <td>";
                // line 55
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "id", [], "any", false, false, false, 55), "html", null, true);
                yield "</td>
                  <td>";
                // line 56
                yield $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemLink("PluginFormcreatorFormAnswer", CoreExtension::getAttribute($this->env, $this->source, $context["row"], "id", [], "any", false, false, false, 56));
                yield "</a></td>
                  <td>";
                // line 57
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "form_name", [], "any", false, false, false, 57), "html", null, true);
                yield "</td>
                  <td>";
                // line 58
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "requester_name", [], "any", false, false, false, 58), "html", null, true);
                yield "</td>
                  <td>";
                // line 59
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "request_date", [], "any", false, false, false, 59), "html", null, true);
                yield "</td>
               </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 62
            yield "         </tbody>
      </table>
   </div>
";
        }
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@formcreator/pages/form.formanswer.html.twig";
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
        return array (  128 => 62,  119 => 59,  115 => 58,  111 => 57,  107 => 56,  103 => 55,  100 => 54,  96 => 53,  89 => 49,  85 => 48,  81 => 47,  77 => 46,  73 => 45,  62 => 39,  58 => 38,  55 => 37,  52 => 36,  46 => 33,  43 => 32,  41 => 31,  38 => 30,);
    }

    public function getSourceContext()
    {
        return new Source("", "@formcreator/pages/form.formanswer.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\plugins\\formcreator\\templates\\pages\\form.formanswer.html.twig");
    }
}
