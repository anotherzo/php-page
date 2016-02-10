<td class="contentframe">
<div class="menu">
  {section name=cat loop=$pageCats}
  {if $pageCats[cat]->tblid == $activeId}
  <p class="active">
  {else}
  <p>
  {/if}
    <a href="{$uriHead}{$pageCats[cat]->uri()}"><span class="de">{$pageCats[cat]->title_de()}</span><br /><span class="en">{$pageCats[cat]->title_en()}</span></a>
    {include file="menuControls.tpl"}
  </p>
  {/section}
  {if isset($loggedIn)}
  <p>
    <a href="{$uriHead}admin/logout">Abmelden</a>
  </p>
  {/if}
  <div class="space"></div>
  <div class="measure">
    <img src="{$uriHead}img/layout/measure.png" alt="Takt-Logo" />
  </div>
  <div class="logo">
    <img src="{$uriHead}img/layout/logo.png" alt="Logo Partitura-Verlag" />
  </div>
  <p class="address">Partitura Verlag AG<br />
    Marktgasse 9<br />
    CH-8400 Winterthur<br />
    info@partitura-verlag.com<br />
    www.partitura-verlag.com<br />
    ++41 52 203 27 72
  </p>
</div>
</td>
<td class="contentframe">
  <div class="content">