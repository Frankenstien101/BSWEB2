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

/* components/itilobject/answer.html.twig */
class __TwigTemplate_4ce3408b86f3e2062c6c5e4894ebfe655732acf6800984f7c2b10fa01042f4ef extends Template
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
<div id=\"new-itilobject-form\" class=\"ms-auto ps-3\">
   ";
        // line 35
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["timeline_itemtypes"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["timeline_itemtype"]) {
            // line 36
            yield "      ";
            $context["show_kb_sol"] = ((1 === CoreExtension::compare(($context["load_kb_sol"] ?? null), 0)) && (0 === CoreExtension::compare(CoreExtension::getAttribute($this->env, $this->source, $context["timeline_itemtype"], "type", [], "any", false, false, false, 36), "ITILSolution")));
            // line 37
            yield "      <div class=\"timeline-item mb-3  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["timeline_itemtype"], "type", [], "any", false, false, false, 37), "html", null, true);
            yield " collapse ";
            yield ((($context["show_kb_sol"] ?? null)) ? ("show") : (""));
            yield "\"
        id=\"new-";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["timeline_itemtype"], "class", [], "any", false, false, false, 38), "html", null, true);
            yield "-block\" aria-expanded=\"false\" data-bs-parent=\"#new-itilobject-form\">
         <div class=\"row\">
            <div class=\"col-auto order-last d-none d-md-block\">
               ";
            // line 41
            yield Twig\Extension\CoreExtension::include($this->env, $context, "components/user/picture.html.twig", ["users_id" => $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiID")], false);
            yield "
            </div>
            <div class=\"col\">
               <div class=\"row timeline-content t-right card mt-4\">
                  <div class=\"card-body\">
                     <div class=\"clearfix\">
                        <button class=\"btn btn-sm btn-ghost-secondary float-end mb-1 close-itil-answer\"
                              data-bs-toggle=\"collapse\" data-bs-target=\"#new-";
            // line 48
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["timeline_itemtype"], "class", [], "any", false, false, false, 48), "html", null, true);
            yield "-block\">
                           <i class=\"fa-lg ti ti-x\"></i>
                        </button>
                     </div>
                     <div>
                        ";
            // line 53
            if (CoreExtension::getAttribute($this->env, $this->source, $context["timeline_itemtype"], "template", [], "any", true, true, false, 53)) {
                // line 54
                yield "                           ";
                yield Twig\Extension\CoreExtension::include($this->env, $context, CoreExtension::getAttribute($this->env, $this->source, $context["timeline_itemtype"], "template", [], "any", false, false, false, 54), ["item" =>                 // line 55
($context["item"] ?? null), "subitem" => CoreExtension::getAttribute($this->env, $this->source,                 // line 56
$context["timeline_itemtype"], "item", [], "any", false, false, false, 56), "kb_id_toload" =>                 // line 57
($context["load_kb_sol"] ?? null)]);
                // line 58
                yield "
                        ";
            } else {
                // line 60
                yield "                           ";
                $context["sf_options"] = ["parent" => ($context["item"] ?? null)];
                // line 61
                yield "                           ";
                if (($context["show_kb_sol"] ?? null)) {
                    // line 62
                    yield "                              ";
                    $context["sf_options"] = Twig\Extension\CoreExtension::merge(($context["sf_options"] ?? null), ["kb_id_toload" =>                     // line 63
($context["load_kb_sol"] ?? null)]);
                    // line 65
                    yield "                           ";
                }
                // line 66
                yield "                           ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["timeline_itemtype"], "item", [], "any", false, false, false, 66), "showForm", [ -1, ($context["sf_options"] ?? null)], "method", false, false, false, 66), "html", null, true);
                yield "
                        ";
            }
            // line 68
            yield "                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['timeline_itemtype'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        yield "</div>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/itilobject/answer.html.twig";
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
        return array (  144 => 75,  124 => 68,  118 => 66,  115 => 65,  113 => 63,  111 => 62,  108 => 61,  105 => 60,  101 => 58,  99 => 57,  98 => 56,  97 => 55,  95 => 54,  93 => 53,  85 => 48,  75 => 41,  69 => 38,  62 => 37,  59 => 36,  42 => 35,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/answer.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\answer.html.twig");
    }
}
