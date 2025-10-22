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

/* layout/parts/head.html.twig */
class __TwigTemplate_4555d817b3cda023c08b6eb812c07f33370c39696ddd09a40887bbe2a838537b extends Template
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
<!DOCTYPE html>
<html lang=\"";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["lang"] ?? null), "html", null, true);
        yield "\" ";
        if (($context["high_contrast"] ?? null)) {
            yield "data-high-contrast=\"1\"";
        }
        // line 36
        yield "      ";
        ((array_key_exists("glpi_request_id", $context)) ? (yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("data-glpi-request-id=" . ($context["glpi_request_id"] ?? null)), "html", null, true)) : (yield ""));
        yield ">
<head>
   <title>BDSC</title>   <meta charset=\"utf-8\" />

   ";
        // line 41
        yield "   <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" />

   ";
        // line 44
        yield "   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />

   ";
        // line 47
        yield "   <meta name=\"robots\" content=\"noindex, nofollow\" />

    ";
        // line 50
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::merge(($context["custom_header_tags"] ?? null), $this->extensions['Glpi\Application\View\Extension\PluginExtension']->getPluginsHeaderTags(((array_key_exists("is_anonymous_page", $context)) ? (Twig\Extension\CoreExtension::default(($context["is_anonymous_page"] ?? null), false)) : (false)))));
        foreach ($context['_seq'] as $context["_key"] => $context["header_tag"]) {
            // line 51
            yield "        <";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["header_tag"], "tag", [], "any", false, false, false, 51), "html", null, true);
            yield " ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["header_tag"], "properties", [], "any", false, false, false, 51));
            foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
                yield "=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["value"], "html", null, true);
                yield "\" ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            yield "/>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['header_tag'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 53
        yield "
   <meta property=\"glpi:csrf_token\" content=\"";
        // line 54
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Session::getNewCSRFToken(true), "html", null, true);
        yield "\" />

   ";
        // line 56
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::merge(($context["css_files"] ?? null), $this->extensions['Glpi\Application\View\Extension\PluginExtension']->getPluginsCssFiles(((array_key_exists("is_anonymous_page", $context)) ? (Twig\Extension\CoreExtension::default(($context["is_anonymous_page"] ?? null), false)) : (false)))));
        foreach ($context['_seq'] as $context["_key"] => $context["css_file"]) {
            // line 57
            yield "      <link rel=\"stylesheet\" type=\"text/css\" href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\FrontEndAssetsExtension']->cssPath(CoreExtension::getAttribute($this->env, $this->source, $context["css_file"], "path", [], "any", false, false, false, 57), (((CoreExtension::getAttribute($this->env, $this->source, $context["css_file"], "options", [], "any", true, true, false, 57) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["css_file"], "options", [], "any", false, false, false, 57)))) ? (CoreExtension::getAttribute($this->env, $this->source, $context["css_file"], "options", [], "any", false, false, false, 57)) : ([]))), "html", null, true);
            yield "\" />
   ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['css_file'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 59
        yield "
   ";
        // line 60
        yield $this->extensions['Glpi\Application\View\Extension\FrontEndAssetsExtension']->customCss();
        yield "

   <link rel=\"shortcut icon\" type=\"images/x-icon\" href=\"";
        // line 62
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\FrontEndAssetsExtension']->assetPath("/pics/favicon.ico"), "html", null, true);
        yield "\" />

   ";
        // line 64
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["js_files"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["js_file"]) {
            // line 65
            yield "      <script type=\"text/javascript\" src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\FrontEndAssetsExtension']->jsPath(CoreExtension::getAttribute($this->env, $this->source, $context["js_file"], "path", [], "any", false, false, false, 65), (((CoreExtension::getAttribute($this->env, $this->source, $context["js_file"], "options", [], "any", true, true, false, 65) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["js_file"], "options", [], "any", false, false, false, 65)))) ? (CoreExtension::getAttribute($this->env, $this->source, $context["js_file"], "options", [], "any", false, false, false, 65)) : ([]))), "html", null, true);
            yield "\"></script>
   ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['js_file'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        yield "
   ";
        // line 68
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["js_modules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["js_file"]) {
            // line 69
            yield "      <script type=\"module\" src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\FrontEndAssetsExtension']->jsPath(CoreExtension::getAttribute($this->env, $this->source, $context["js_file"], "path", [], "any", false, false, false, 69), (((CoreExtension::getAttribute($this->env, $this->source, $context["js_file"], "options", [], "any", true, true, false, 69) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["js_file"], "options", [], "any", false, false, false, 69)))) ? (CoreExtension::getAttribute($this->env, $this->source, $context["js_file"], "options", [], "any", false, false, false, 69)) : ([]))), "html", null, true);
            yield "\"></script>
   ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['js_file'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 71
        yield "
   ";
        // line 72
        yield $this->extensions['Glpi\Application\View\Extension\FrontEndAssetsExtension']->localesJs();
        yield "
</head>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "layout/parts/head.html.twig";
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
        return array (  160 => 72,  157 => 71,  148 => 69,  144 => 68,  141 => 67,  132 => 65,  128 => 64,  123 => 62,  118 => 60,  115 => 59,  106 => 57,  102 => 56,  97 => 54,  94 => 53,  73 => 51,  68 => 50,  64 => 47,  60 => 44,  56 => 41,  48 => 36,  42 => 35,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "layout/parts/head.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\layout\\parts\\head.html.twig");
    }
}
