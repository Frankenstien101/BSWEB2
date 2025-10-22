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

/* components/itilobject/timeline/form_document_item.html.twig */
class __TwigTemplate_d40db63d99a7b76ead79e384c1af22ea96d35e40e2302d81af3023466b5d3454 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'timeline_card' => [$this, 'block_timeline_card'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 34
        return "components/itilobject/timeline/form_timeline_item.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 35
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/itilobject/timeline/form_document_item.html.twig", 35)->unwrap();
        // line 34
        $this->parent = $this->loadTemplate("components/itilobject/timeline/form_timeline_item.html.twig", "components/itilobject/timeline/form_document_item.html.twig", 34);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 37
    public function block_timeline_card($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 38
        yield "   ";
        if ((0 === CoreExtension::compare(($context["form_mode"] ?? null), "view"))) {
            // line 39
            yield "      <div class=\"row align-items-center m-n2\">
         ";
            // line 40
            $context["name"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["entry_i"] ?? null), "name", [], "array", true, true, false, 40) &&  !(null === (($__internal_compile_0 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["name"] ?? null) : null)))) ? ((($__internal_compile_1 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["name"] ?? null) : null)) : ((($__internal_compile_2 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["filename"] ?? null) : null)));
            // line 41
            yield "         ";
            $context["filename"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["entry_i"] ?? null), "filename", [], "array", true, true, false, 41) &&  !(null === (($__internal_compile_3 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["filename"] ?? null) : null)))) ? ((($__internal_compile_4 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["filename"] ?? null) : null)) : ((($__internal_compile_5 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["name"] ?? null) : null)));
            // line 42
            yield "         ";
            $context["fk"] = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getForeignKeyField", [], "method", false, false, false, 42);
            // line 43
            yield "
         ";
            // line 44
            if ((($__internal_compile_6 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["filename"] ?? null) : null)) {
                // line 45
                yield "            ";
                $context["docpath"] = $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path(((((("front/document.send.php?docid=" . (($__internal_compile_7 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["id"] ?? null) : null)) . "&") . ($context["fk"] ?? null)) . "=") . (($__internal_compile_8 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 45)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["id"] ?? null) : null)));
                // line 46
                yield "            <div class=\"col text-truncate\">
               <a href=\"";
                // line 47
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["docpath"] ?? null), "html", null, true);
                yield "\" target=\"_blank\" title=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["name"] ?? null), "html", null, true);
                yield "\">
                  <img src=\"";
                // line 48
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\DocumentExtension']->getDocumentIcon(($context["filename"] ?? null)), "html", null, true);
                yield "\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("File extension"), "html", null, true);
                yield "\" />
                  ";
                // line 49
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["filename"] ?? null), "html", null, true);
                yield "
               </a>
            </div>
         ";
            }
            // line 53
            yield "
         ";
            // line 54
            if ((($__internal_compile_9 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["link"] ?? null) : null)) {
                // line 55
                yield "            <div class=\"col-auto\">
               <a href=\"";
                // line 56
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_10 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["link"] ?? null) : null), "html", null, true);
                yield "\" target=\"_blank\">
                  <i class=\"ti ti-external-link\"></i>
                  ";
                // line 58
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_11 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["name"] ?? null) : null), "html", null, true);
                yield "
               </a>
            </div>
         ";
            }
            // line 62
            yield "
         ";
            // line 63
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["entry_i"] ?? null), "filepath", [], "array", true, true, false, 63) &&  !(null === (($__internal_compile_12 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["filepath"] ?? null) : null)))) {
                // line 64
                yield "            <div class=\"col-auto text-muted ms-2\">
               ";
                // line 65
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\DocumentExtension']->getDocumentSize((($__internal_compile_13 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["filepath"] ?? null) : null)), "html", null, true);
                yield "
            </div>
         ";
            }
            // line 68
            yield "
         <div class=\"col-auto\">
            <div class=\"list-group-item-actions\">
               ";
            // line 71
            if ((($__internal_compile_14 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["_can_edit"] ?? null) : null)) {
                // line 72
                yield "                  <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeFormPath("Document", (($__internal_compile_15 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["id"] ?? null) : null)), "html", null, true);
                yield "\"
                     class=\"btn btn-sm btn-ghost-secondary\" title=\"";
                // line 73
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Edit"), "html", null, true);
                yield "\"
                     data-bs-toggle=\"tooltip\" data-bs-placement=\"top\">
                     <i class=\"ti ti-edit\"></i>
                  </a>
               ";
            }
            // line 78
            yield "
               ";
            // line 79
            if ((($__internal_compile_16 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["_can_delete"] ?? null) : null)) {
                // line 80
                yield "                  <form class=\"d-inline\" method=\"post\" action=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getFormURL", [], "method", false, false, false, 80), "html", null, true);
                yield "\">
                     <input type=\"hidden\" name=\"";
                // line 81
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["fk"] ?? null), "html", null, true);
                yield "\" value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_17 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 81)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["id"] ?? null) : null), "html", null, true);
                yield "\">
                     <input type=\"hidden\" name=\"documents_id\" value=\"";
                // line 82
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_18 = ($context["entry_i"] ?? null)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["id"] ?? null) : null), "html", null, true);
                yield "\">
                     <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
                // line 83
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Session::getNewCSRFToken(), "html", null, true);
                yield "\" />
                     <button type=\"submit\" class=\"btn btn-sm btn-ghost-secondary\" name=\"delete_document\"
                             title=\"";
                // line 85
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Delete permanently"), "html", null, true);
                yield "\"
                             data-bs-toggle=\"tooltip\" data-bs-placement=\"top\">
                        <i class=\"ti ti-trash\"></i>
                     </button>
                  </form>
               ";
            }
            // line 91
            yield "            </div>
         </div>
      </div>
    ";
        } else {
            // line 95
            yield "        <div class=\"document_item\">
            <form name=\"asset_form\" style=\"width: 100%;\" class=\"d-flex flex-column\" method=\"post\"
                action=\"";
            // line 97
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeFormPath("Document"), "html", null, true);
            yield "\" enctype=\"multipart/form-data\" data-track-changes=\"true\" data-submit-once>
                <input type=\"hidden\" name=\"entities_id\" value=\"";
            // line 98
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getEntityID", [], "method", false, false, false, 98), "html", null, true);
            yield "\" />
                <input type=\"hidden\" name=\"is_recursive\" value=\"";
            // line 99
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isRecursive", [], "method", false, false, false, 99), "html", null, true);
            yield "\" />
                <input type=\"hidden\" name=\"itemtype\" value=\"";
            // line 100
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 100), "html", null, true);
            yield "\" />
                <input type=\"hidden\" name=\"items_id\" value=\"";
            // line 101
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_19 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 101)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["id"] ?? null) : null), "html", null, true);
            yield "\" />
                <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
            // line 102
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Session::getNewCSRFToken(), "html", null, true);
            yield "\" />
                ";
            // line 103
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHook("pre_item_form", ["item" => ($context["subitem"] ?? null), "options" => ($context["params"] ?? null)]), "html", null, true);
            yield "

                ";
            // line 105
            if ((0 === CoreExtension::compare($this->extensions['Glpi\Application\View\Extension\SessionExtension']->getCurrentInterface(), "central"))) {
                // line 106
                yield "                    ";
                yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["DocumentCategory", "documentcategories_id", null, __("Heading"), ["label_class" => "col-xxl-3", "field_class" => "col-xxl-11", "full_width" => true, "is_horizontal" => false]], 106, $context, $this->getSourceContext());
                // line 117
                yield "
                ";
            }
            // line 119
            yield "
                ";
            // line 120
            $context["max_size"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 121
                yield "                    <div class=\"alert alert-info\">
                        ";
                // line 122
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Document::getMaxUploadSize"), "html", null, true);
                yield "
                    </div>
                ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 125
            yield "
                ";
            // line 126
            yield CoreExtension::callMacro($macros["fields"], "macro_fileField", ["filename", null, __("File"), ["multiple" => true, "label_class" => "col-xxl-3", "field_class" => "col-xxl-11", "full_width" => true, "is_horizontal" => false, "add_field_html" =>             // line 136
($context["max_size"] ?? null)]], 126, $context, $this->getSourceContext());
            // line 138
            yield "

                ";
            // line 140
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHook("post_item_form", ["item" => ($context["subitem"] ?? null), "options" => ($context["params"] ?? null)]), "html", null, true);
            yield "

                <div class=\"d-flex card-footer mx-n3 mb-n3\">
                    ";
            // line 143
            if ((0 >= CoreExtension::compare((($__internal_compile_20 = CoreExtension::getAttribute($this->env, $this->source, ($context["subitem"] ?? null), "fields", [], "any", false, false, false, 143)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["id"] ?? null) : null), 0))) {
                // line 144
                yield "                        <div class=\"input-group\">
                            <button class=\"btn btn-primary\" type=\"submit\" name=\"add\">
                                <i class=\"ti ti-file-plus\"></i>
                                <span>";
                // line 147
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Add a new file"), "html", null, true);
                yield "</span>
                            </button>
                        </div>
                    ";
            }
            // line 151
            yield "                </div>
            </form>
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
        return "components/itilobject/timeline/form_document_item.html.twig";
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
        return array (  279 => 151,  272 => 147,  267 => 144,  265 => 143,  259 => 140,  255 => 138,  253 => 136,  252 => 126,  249 => 125,  242 => 122,  239 => 121,  237 => 120,  234 => 119,  230 => 117,  227 => 106,  225 => 105,  220 => 103,  216 => 102,  212 => 101,  208 => 100,  204 => 99,  200 => 98,  196 => 97,  192 => 95,  186 => 91,  177 => 85,  172 => 83,  168 => 82,  162 => 81,  157 => 80,  155 => 79,  152 => 78,  144 => 73,  139 => 72,  137 => 71,  132 => 68,  126 => 65,  123 => 64,  121 => 63,  118 => 62,  111 => 58,  106 => 56,  103 => 55,  101 => 54,  98 => 53,  91 => 49,  85 => 48,  79 => 47,  76 => 46,  73 => 45,  71 => 44,  68 => 43,  65 => 42,  62 => 41,  60 => 40,  57 => 39,  54 => 38,  50 => 37,  45 => 34,  43 => 35,  36 => 34,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/timeline/form_document_item.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\timeline\\form_document_item.html.twig");
    }
}
