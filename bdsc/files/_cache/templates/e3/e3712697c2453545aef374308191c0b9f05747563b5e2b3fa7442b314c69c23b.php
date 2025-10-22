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

/* layout/parts/saved_searches_list.html.twig */
class __TwigTemplate_9645106334869b0a41e0a8e8630f2e866e5ba174c225d1cbcfff3e9a3e94f042 extends Template
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
        if ((0 === CoreExtension::compare(Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["saved_searches"] ?? null)), 0))) {
            // line 35
            yield "   <div class=\"alert alert-info\" role=\"alert\">
      ";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("You have not recorded any saved searches yet"), "html", null, true);
            yield "
   </div>
";
        }
        // line 39
        yield "
<div class='sortable-savedsearches'>
";
        // line 41
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["saved_searches"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["search"]) {
            // line 42
            yield "   <div class=\"savedsearches-item grip-savedsearch list-group-item search-line d-flex align-items-center pe-1 ";
            yield (((0 === CoreExtension::compare(($context["active"] ?? null), (($__internal_compile_0 = $context["search"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["id"] ?? null) : null)))) ? ("active") : (""));
            yield "\"
         data-id=\"";
            // line 43
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_1 = $context["search"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["id"] ?? null) : null), "html", null, true);
            yield "\">
      ";
            // line 44
            if ( !(($__internal_compile_2 = $context["search"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["_error"] ?? null) : null)) {
                // line 45
                yield "          <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeSearchPath("SavedSearch"), "html", null, true);
                yield "?action=load&amp;id=";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_3 = $context["search"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["id"] ?? null) : null), "html", null, true);
                yield "\"
             class=\"d-block saved-searches-link text-truncate\">
             ";
                // line 47
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue((($__internal_compile_4 = $context["search"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["name"] ?? null) : null)), "html", null, true);
                yield "
          </a>
      ";
            } else {
                // line 50
                yield "          <span class=\"d-block text-truncate\">
              ";
                // line 51
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue((($__internal_compile_5 = $context["search"]) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["name"] ?? null) : null)), "html", null, true);
                yield "
          </span>
      ";
            }
            // line 54
            yield "      <div class=\"";
            yield (((1 === CoreExtension::compare((($__internal_compile_6 = $context["search"]) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["is_default"] ?? null) : null), 0))) ? ("") : ("list-group-item-actions"));
            yield " ms-auto default-ctrl\">
          ";
            // line 55
            if ( !(($__internal_compile_7 = $context["search"]) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["_error"] ?? null) : null)) {
                // line 56
                yield "             <i class=\"";
                yield (((1 === CoreExtension::compare((($__internal_compile_8 = $context["search"]) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["is_default"] ?? null) : null), 0))) ? ("fas") : ("far"));
                yield " fa-star fa-xs mark-default me-1\"
                title=\"";
                // line 57
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((((1 === CoreExtension::compare((($__internal_compile_9 = $context["search"]) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["is_default"] ?? null) : null), 0))) ? (__("Default search")) : (__("mark as default"))), "html", null, true);
                yield "\"
                data-bs-toggle=\"tooltip\" data-bs-placement=\"right\"
                role=\"button\"></i>
          ";
            }
            // line 61
            yield "      </div>
      <div class=\"d-flex flex-nowrap align-items-center\">
         ";
            // line 63
            if ((0 === CoreExtension::compare((($__internal_compile_10 = $context["search"]) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["is_private"] ?? null) : null), 1))) {
                // line 64
                yield "         <i class=\"ti ti-lock fa-xs text-muted me-1\" title=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("private"), "html", null, true);
                yield "\"
            data-bs-toggle=\"tooltip\" data-bs-placement=\"right\"></i>
         ";
            }
            // line 67
            yield "         <span class=\"badge\">
            ";
            // line 68
            yield (($__internal_compile_11 = $context["search"]) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["count"] ?? null) : null);
            yield "
         </span>
      </div>
   </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['search'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 73
        yield "</div>

<script type=\"text/javascript\">
\$(function() {
   sortable('.sortable-savedsearches', {
      placeholder: '<div class=\"sortable-placeholder\">&nbsp;</div>',
   })
   \$('.sortable-savedsearches').on('sortupdate', function(e) {
      var _ids = \$('.savedsearches-item').map(function(idx, ele) {
         return \$(ele).data('id');
      }).get();

      \$.post(CFG_GLPI['root_doc']+'/ajax/savedsearch.php', {
         'action': 'reorder',
         'ids': _ids,
      });

      displayAjaxMessageAfterRedirect();
   });
});
</script>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "layout/parts/saved_searches_list.html.twig";
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
        return array (  140 => 73,  129 => 68,  126 => 67,  119 => 64,  117 => 63,  113 => 61,  106 => 57,  101 => 56,  99 => 55,  94 => 54,  88 => 51,  85 => 50,  79 => 47,  71 => 45,  69 => 44,  65 => 43,  60 => 42,  56 => 41,  52 => 39,  46 => 36,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "layout/parts/saved_searches_list.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\layout\\parts\\saved_searches_list.html.twig");
    }
}
