<?php
// $Id$

/**
 * @file
 * Hooks provided by the Entity cache module.
 */

/**
 * Resolve $conditions passed to entity_load() into an array of ids.
 *
 * This hook allows modules to fetch IDs for entities when $conditions is
 * passed to entity_load(). For example taxonomy_get_term_by_name() or
 * user_load_by_mail(). This allows entity cache to fetch those entities from
 * cache using the $ids array as if it had been passed into entity_load()
 * directly.
 *
 * @param $ids
 *   The $ids array passed into entity_load(), may be an empty array.
 * @param $conditions
 *   The $conditions array passed into entity_load(), an array of table column
 *   value pairs.
 * @param $entity_type
 *   The entity type being loaded.
 */
function hook_entitycache_resolve_conditions($ids, $conditions, $entity_type) {
  // Run a query on the fields_current_collection.
  return $ids;
}
